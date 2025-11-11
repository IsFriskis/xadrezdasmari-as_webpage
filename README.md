# xadrezdasmari-as_webpage

Modern website for Xadrez das Mariñas chess club built with Astro.

## 🚀 Project Structure

```
/
├── public/
│   └── favicon.svg
├── src/
│   ├── components/
│   │   ├── BlogCard.astro
│   │   ├── Footer.astro
│   │   └── Header.astro
│   ├── layouts/
│   │   └── BaseLayout.astro
│   ├── pages/
│   │   ├── blog/
│   │   │   └── [slug].astro
│   │   ├── about.astro
│   │   ├── blog.astro
│   │   ├── contact.astro
│   │   └── index.astro
│   └── styles/
│       └── global.css
├── astro.config.mjs
├── package.json
└── tsconfig.json
```

## 🎨 Features

- **Modern Design**: Clean, responsive design with chess-themed branding
- **Blog System**: Dynamic blog with multiple posts and individual post pages
- **Prismic CMS**: Optional content management through Prismic CMS with automatic fallback to local content
- **Multilingual**: Content in Galician language
- **SEO Optimized**: Proper meta tags and semantic HTML
- **Mobile Responsive**: Works perfectly on all device sizes
- **Fast Performance**: Static site generation with Astro

## 🧞 Commands

All commands are run from the root of the project, from a terminal:

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |
| `npm run astro ...`       | Run CLI commands like `astro add`, `astro check` |

## 📄 Pages

- **Home** (`/`) - Hero section, featured activities, and latest blog posts
- **Blog** (`/blog`) - All blog posts in a grid layout
- **Blog Post** (`/blog/[slug]`) - Individual blog post pages
- **About** (`/about`) - Information about the chess club
- **Contact** (`/contact`) - Contact form and information

## 🎯 Technologies

- [Astro](https://astro.build/) - Static site generator
- [Prismic](https://prismic.io/) - Headless CMS for content management (optional)
- TypeScript - Type safety
- CSS - Modern styling with CSS variables

## 📚 Documentation

- [PRISMIC_SETUP.md](xdmpage/PRISMIC_SETUP.md) - Complete guide for setting up Prismic CMS integration

## 📝 License

See LICENSE file for details.