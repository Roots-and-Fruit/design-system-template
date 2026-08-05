# Logos

Drop your marks here, then point the Media Kit and product chrome at them.
Suggested layout:

```
assets/
  mark.svg                 # square icon: favicons, avatars, tight badges
  logos/
    wordmark.svg           # full lockup for light backgrounds (+ wordmark.png)
    wordmark-white.svg     # monotone reverse for dark backgrounds (+ .png)
    wordmark-mono.svg      # single-colour black fallback (+ .png)
```

The Media Kit page (`media-kit.html`) is the outsider-facing pack: those three
wordmarks with SVG/PNG downloads, Good/Bad usage, and pasteable copy. Fill the
`mediaKit` object in `brand.json` (short name, website, contact email,
boilerplate, one-liner), then run `npm run customize`.

Two rules worth keeping:

1. The wordmark names the brand; the square mark is for spaces too small for a
   wordmark. They are not interchangeable.
2. Never add shadows, outlines, recolours, or stretch transforms to a mark file.
   If a surface needs a different treatment, export a new file.

If your marks or fonts are licensed rather than owned, do not commit the
binaries to a public repository. Keep them on a host you control and reference
them by URL.
