# Logos

Drop your marks here, then point `index.html`, favicons, and any product chrome
at them. Suggested layout:

```
assets/
  mark.svg              # square icon: favicons, avatars, tight badges
  logos/
    wordmark.svg        # full lockup for light backgrounds
    wordmark-dark.svg   # lockup for dark backgrounds
    wordmark-mono.svg   # single-colour fallback (print, stamps)
```

Two rules worth keeping:

1. The wordmark names the brand; the square mark is for spaces too small for a
   wordmark. They are not interchangeable.
2. Never add shadows, outlines, recolours, or stretch transforms to a mark file.
   If a surface needs a different treatment, export a new file.

If your marks or fonts are licensed rather than owned, do not commit the
binaries to a public repository. Keep them on a host you control and reference
them by URL.
