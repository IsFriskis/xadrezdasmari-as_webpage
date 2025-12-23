# Xadrez das Mariñas - Astro Frontend

This is the Astro frontend for the Xadrez das Mariñas website, integrated with PayloadCMS.

## Structure

```
frontend/
├── src/
│   ├── layouts/
│   │   └── BaseLayout.astro    # Base layout component
│   ├── pages/
│   │   └── index.astro         # Home page
│   └── components/             # Reusable components
├── public/                     # Static assets
├── astro.config.mjs           # Astro configuration
├── package.json               # Dependencies
└── tsconfig.json              # TypeScript configuration
```

## Getting Started

1. Install dependencies:
   ```bash
   npm install
   ```

2. Start the development server:
   ```bash
   npm run dev
   ```

3. Open [http://localhost:4321](http://localhost:4321) in your browser.

## Integration with PayloadCMS

The frontend connects to the PayloadCMS backend running on `http://localhost:3000`. You can fetch data from PayloadCMS collections using the REST API:

```javascript
const response = await fetch('http://localhost:3000/api/your-collection');
const data = await response.json();
```

## Configuration

Copy `.env.example` to `.env` and configure the PayloadCMS API URL:

```
PAYLOAD_API_URL=http://localhost:3000
```

## Building for Production

```bash
npm run build
```

The build output will be in the `dist/` directory.

## Commands

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run preview` - Preview production build
- `npm run astro` - Run Astro CLI commands
