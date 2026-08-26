/**
 * Small YAML map parser for DESIGN.md front matter.
 * Handles nested maps, quoted scalars, and `>-` folded blocks.
 * Not a general YAML implementation.
 */

function unquote(value) {
  const s = String(value).trim();
  if (
    (s.startsWith('"') && s.endsWith('"')) ||
    (s.startsWith("'") && s.endsWith("'"))
  ) {
    return s.slice(1, -1);
  }
  return s;
}

function coerceScalar(value) {
  if (value === "true") return true;
  if (value === "false") return false;
  if (value === "null" || value === "~") return null;
  if (/^-?\d+$/.test(value)) return Number(value);
  if (/^-?\d+\.\d+$/.test(value)) return Number(value);
  return value;
}

function foldBlockScalars(text) {
  const lines = text.replace(/\r\n/g, "\n").split("\n");
  const out = [];
  for (let i = 0; i < lines.length; i++) {
    const match = lines[i].match(/^(\s*)([^:]+):\s*>-?\s*$/);
    if (!match) {
      out.push(lines[i]);
      continue;
    }
    const indent = match[1].length;
    const parts = [];
    let j = i + 1;
    while (j < lines.length) {
      const next = lines[j];
      if (next.trim() === "") {
        j++;
        continue;
      }
      const nextIndent = next.match(/^ */)[0].length;
      if (nextIndent <= indent) break;
      parts.push(next.trim());
      j++;
    }
    out.push(`${match[1]}${match[2]}: ${JSON.stringify(parts.join(" "))}`);
    i = j - 1;
  }
  return out.join("\n");
}

export function parseYamlMap(text) {
  const folded = foldBlockScalars(text);
  const lines = folded
    .split("\n")
    .filter((line) => line.trim() !== "" && !line.trim().startsWith("#"));

  const root = {};
  const stack = [{ indent: -1, obj: root }];

  for (const line of lines) {
    const indent = line.match(/^ */)[0].length;
    const trimmed = line.trim();
    const match = trimmed.match(/^([^:]+):\s*(.*)$/);
    if (!match) continue;

    const key = match[1].trim();
    const raw = match[2];

    while (stack.length && indent <= stack[stack.length - 1].indent) {
      stack.pop();
    }
    const parent = stack[stack.length - 1].obj;

    if (raw === "") {
      const child = {};
      parent[key] = child;
      stack.push({ indent, obj: child });
    } else {
      parent[key] = coerceScalar(unquote(raw));
    }
  }

  return root;
}

export function parseDesignMdFrontMatter(markdown) {
  const match = markdown.match(/^---\r?\n([\s\S]*?)\r?\n---\r?\n/);
  if (!match) {
    throw new Error("DESIGN.md is missing YAML front matter");
  }
  return parseYamlMap(match[1]);
}

export function parseCdsTokens(css) {
  const tokens = {};
  for (const match of css.matchAll(/--cds-([a-z0-9-]+)\s*:\s*([^;]+);/gi)) {
    tokens[match[1]] = match[2].trim();
  }
  return tokens;
}

export function resolveInlineRefs(value, design, tokens) {
  if (value == null) return value;
  return String(value).replace(/\{([a-z0-9.-]+)\}/gi, (all, path) => {
    const resolved = resolveTokenRef(`{${path}}`, design, tokens);
    return resolved == null ? all : String(resolved);
  });
}

export function resolveTokenRef(value, design, tokens, seen = new Set()) {
  if (value == null) return value;
  const raw = String(value).trim();

  const designRef = raw.match(/^\{([a-z0-9.-]+)\}$/i);
  if (designRef) {
    const path = designRef[1].split(".");
    let cur = design;
    for (const part of path) {
      if (cur == null || typeof cur !== "object") return raw;
      cur = cur[part];
    }
    return resolveTokenRef(cur, design, tokens, seen);
  }

  const cssRef = raw.match(/^var\(--cds-([a-z0-9-]+)\)$/i);
  if (cssRef) {
    const name = cssRef[1];
    if (seen.has(name)) return raw;
    seen.add(name);
    if (tokens[name] == null) return raw;
    return resolveTokenRef(tokens[name], design, tokens, seen);
  }

  return raw;
}
