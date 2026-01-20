# DD Web Theme - Build & Development Guide

## Stack
- **Templating**: Laravel Blade
- **Styling**: TailwindCSS 3.x
- **JavaScript**: TypeScript
- **Build Tool**: Vite

## Installation

1. Install dependencies:
```bash
npm install
```

2. Install Composer dependencies (already done):
```bash
composer install
```

## Development

### Start Development Server
```bash
npm run dev
```
This will:
- Start Vite dev server on http://localhost:5173
- Enable hot module replacement (HMR)
- Auto-reload on file changes
- Load assets from dev server

**Important**: Keep this running while developing!

### Build for Production
```bash
npm run build
```
This will:
- Compile TypeScript to JavaScript
- Process TailwindCSS
- Minify and optimize all assets
- Generate manifest.json for WordPress
- Output to `dist/` directory

### Watch Mode (Production Build)
```bash
npm run watch
```
Rebuilds on file changes but outputs production files.

## File Structure

```
dd-web/
├── assets/
│   ├── css/
│   │   └── main.css          # TailwindCSS entry
│   └── ts/
│       └── main.ts           # TypeScript entry
├── resources/views/          # Blade templates
├── dist/                     # Compiled assets (gitignored)
├── tailwind.config.js        # Tailwind configuration
├── vite.config.js            # Vite configuration
├── tsconfig.json             # TypeScript configuration
└── package.json              # NPM dependencies
```

## Using TailwindCSS

### In Blade Templates
```blade
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-bold text-gray-900">Hello</h1>
    <button class="btn btn-primary">Click me</button>
</div>
```

### Custom Components (defined in main.css)
- `.btn` - Base button styles
- `.btn-primary` - Primary button
- `.btn-secondary` - Secondary button
- `.btn-light` - Light button
- `.section` - Section spacing
- `.section-heading` - Section headings
- `.card` - Card component

### Extending Tailwind
Edit `tailwind.config.js` to add custom colors, spacing, etc.

## TypeScript

### Type Definitions
- jQuery types included via `@types/jquery`
- WordPress types via `@types/wordpress__blocks`
- Custom types in `.ts` files

### Main Class: DDWebTheme
Located in `assets/ts/main.ts`:
```typescript
// Auto-initialized on document ready
// Handles:
// - Mobile menu
// - Smooth scrolling
// - Header scroll effects
// - AJAX calls
```

### Adding Custom TypeScript
Create new `.ts` files in `assets/ts/` and import in `main.ts`:
```typescript
import MyModule from './modules/my-module';
```

## WordPress Integration

### Asset Loading
The theme automatically detects environment:
- **Development**: Loads from Vite dev server (localhost:5173)
- **Production**: Loads compiled files from `dist/`

### Switching Modes
Just run `npm run build` to generate production files. WordPress will automatically switch to production mode when `dist/manifest.json` exists.

## Deployment Workflow

1. **Development**:
   ```bash
   npm run dev
   # Develop with HMR
   ```

2. **Before Commit**:
   ```bash
   npm run build
   # Commit dist/ if needed, or add to .gitignore
   ```

3. **Production Server**:
   - Upload theme files
   - Run `npm install` (if node_modules not included)
   - Run `npm run build`
   - Activate theme in WordPress

## TailwindCSS Purging

TailwindCSS automatically purges unused styles in production based on:
- `resources/views/**/*.blade.php`
- `assets/ts/**/*.ts`
- `./**/*.php`

Only classes actually used in your code will be included in the final CSS.

## Troubleshooting

### Assets not loading?
- Check if `npm run dev` is running (development)
- Check if `dist/` folder exists (production)
- Clear WordPress cache
- Check browser console for errors

### TailwindCSS classes not working?
- Ensure classes are in purge path (tailwind.config.js)
- Run `npm run build` to regenerate CSS
- Check for typos in class names

### TypeScript errors?
- Run `npx tsc --noEmit` to check types
- Check `tsconfig.json` configuration
- Ensure all types are installed

## Performance Tips

1. **Use production build** on live sites
2. **Enable caching** in WordPress
3. **Optimize images** before uploading
4. **Lazy load** components when possible
5. **Split code** for larger applications (configure in vite.config.js)

## Custom Vite Configuration

Edit `vite.config.js` to:
- Add aliases
- Configure build options
- Add plugins
- Optimize bundle splitting
