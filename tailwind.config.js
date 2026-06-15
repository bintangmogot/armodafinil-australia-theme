/** @type {import('tailwindcss').Config} */
module.exports = {
  /*
   * CONTENT — tells Tailwind which files to scan for class names.
   * Tailwind reads these files, finds every class you used (like "bg-white",
   * "text-lg", "px-4"), and only includes THOSE classes in the output CSS.
   * This keeps the final CSS file tiny!
   */
  content: [
    './**/*.php',              // All PHP template files
    './assets/js/**/*.js',     // JavaScript files (in case you add classes dynamically)
  ],

  theme: {
    extend: {
      /*
       * ── CUSTOM COLORS ──
       * Add your brand colors here. Use them like: bg-brand, text-brand-dark
       * You can change these to match your pharmacy's branding!
       */
      colors: {
        brand: {
          50:  '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9',   // Primary brand color
          600: '#0284c7',
          700: '#0369a1',
          800: '#075985',
          900: '#0c4a6e',
          950: '#082f49',
        },
      },

      /*
       * ── FONTS ──
       * You can add Google Fonts here. Load them in header.php first, then reference here.
       * Example: font-sans will use Inter instead of the browser default.
       */
      fontFamily: {
        // sans: ['Inter', 'system-ui', 'sans-serif'],
      },
    },
  },

  plugins: [],
}
