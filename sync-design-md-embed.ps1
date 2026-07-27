# Embed DESIGN.md into the reference site page that displays it (design-md.html).
#
# DESIGN.md stays canonical; the HTML copy exists so the page works when opened
# straight from disk (no server, no fetch). Re-run after every DESIGN.md edit.
# Node users can run sync-design-md-embed.mjs instead.

$ErrorActionPreference = "Stop"

$root = $PSScriptRoot
$mdPath = Join-Path $root "DESIGN.md"
$htmlPath = Join-Path $root "design-md.html"

if (-not (Test-Path $mdPath)) { throw "Missing DESIGN.md at $mdPath" }
if (-not (Test-Path $htmlPath)) { throw "Missing design-md.html at $htmlPath" }

$md = Get-Content -Raw -Encoding UTF8 $mdPath
# Normalise to LF so the embed matches the file on disk byte for byte.
$md = ($md -replace "`r`n", "`n" -replace "`r", "`n").TrimEnd() + "`n"

$html = Get-Content -Raw -Encoding UTF8 $htmlPath
if ($html -notmatch 'id="design-md-source"') {
  throw 'design-md.html is missing <code id="design-md-source">'
}

$escaped = [System.Net.WebUtility]::HtmlEncode($md)
$pattern = '(?s)(<code id="design-md-source">).*?(</code>)'
$updated = [regex]::Replace($html, $pattern, "`${1}$escaped`${2}", 1)

Set-Content -Path $htmlPath -Value $updated -Encoding UTF8 -NoNewline

$lines = ($md -split "`n").Count
Write-Host "Embedded DESIGN.md into design-md.html ($lines lines)."
