# xadrezdasmari-as_webpage

Modern website for Xadrez das Mariñas chess club.

## 📁 Projects

This repository contains two projects:

### xdmpage
Static website built with Astro and DecapCMS.
- Located in `/xdmpage`
- See [xdmpage documentation](./xdmpage/README.md)

### xdmpayload
Modern web application with PayloadCMS backend and Astro frontend.
- Located in `/xdmpayload`
- Backend: PayloadCMS (headless CMS with admin panel)
- Frontend: Astro (static site generator)
- See [xdmpayload documentation](./xdmpayload/PROJECT_README.md)

## 🚀 Getting Started

### xdmpage (Astro + DecapCMS)

```bash
cd xdmpage
npm install
npm run dev
```

### xdmpayload (PayloadCMS + Astro)

#### Start Backend (PayloadCMS)
```bash
cd xdmpayload
npm install
npm run dev
```
Access admin panel at http://localhost:3000/admin

#### Start Frontend (Astro)
```bash
cd xdmpayload/frontend
npm install
npm run dev
```
Access website at http://localhost:4321

## 🚀 Project Structure (xdmpage)

```
/
├── public/
│   ├── _redirects
│   ├── logo fegaxa.jfif
│   ├── logo xogade.jfif
│   ├── admin/
│   │   ├── config.yml
│   │   └── index.html
│   └── images/
│       └── uploads/
├── src/
│   ├── components/
│   │   ├── BlogCard.astro
│   │   ├── Footer.astro
│   │   └── Header.astro
│   ├── content/
│   │   ├── config.ts
│   │   └── blog/
│   │       ├── benvida-xadrez-marinas.md
│   │       ├── estratexias-mellorar-xogo.md
│   │       ├── historia-xadrez-galicia.md
│   │       ├── leccions-principiantes.md
│   │       ├── newblogspot-try.md
│   │       ├── torneo-outono-2024.md
│   │       └── xadrez-desenvolvemento-cognitivo.md
│   ├── layouts/
│   │   └── BaseLayout.astro
│   ├── pages/
│   │   ├── blog/
│   │   │   └── [slug].astro
│   │   ├── about.astro
│   │   ├── blog.astro
│   │   ├── clases.astro
│   │   ├── contact.astro
│   │   ├── index.astro
│   │   └── torneos.astro
│   └── styles/
│       └── global.css
├── astro.config.mjs
├── package.json
├── tsconfig.json
└── netlify.toml
```

## 🎨 Features

- **Modern Design**: Clean, responsive design with chess-themed branding
- **Content Management**: Integrated with Decap CMS for easy content editing
- **Blog System**: Content collections-based blog with multiple posts and individual post pages
- **Multilingual**: Content in Galician language
- **SEO Optimized**: Proper meta tags and semantic HTML
- **Mobile Responsive**: Works perfectly on all device sizes
- **Fast Performance**: Static site generation with Astro
- **Netlify Ready**: Configured for deployment on Netlify with redirects

## 🧞 Commands

All commands are run from the `xdmpage/` directory:

| Command                   | Action                                           |
| :------------------------ | :----------------------------------------------- |
| `npm install`             | Installs dependencies                            |
| `npm run dev`             | Starts local dev server at `localhost:4321`      |
| `npm run start`           | Alias for `npm run dev`                          |
| `npm run build`           | Build your production site to `./dist/`          |
| `npm run preview`         | Preview your build locally, before deploying     |
| `npm run astro ...`       | Run CLI commands like `astro add`, `astro check` |

## 📄 Pages

- **Home** (`/`) - Hero section, featured activities, and latest blog posts
- **Blog** (`/blog`) - All blog posts in a grid layout
- **Blog Post** (`/blog/[slug]`) - Individual blog post pages
- **About** (`/about`) - Information about the chess club
- **Classes** (`/clases`) - Information about chess classes
- **Tournaments** (`/torneos`) - Tournament information and schedules
- **Contact** (`/contact`) - Contact form and information
- **Admin** (`/admin`) - Decap CMS admin panel for content management

## 🎯 Technologies

- [Astro](https://astro.build/) 5.0 - Static site generator
- [Decap CMS](https://decapcms.org/) - Git-based content management system
- TypeScript - Type safety
- CSS - Modern styling with CSS variables

## 🚢 Deployment

This project is configured for deployment on Netlify. See `NETLIFY_DEPLOY.md` for deployment instructions and `DECAP_CMS_SETUP.md` for CMS configuration details.

## 📝 License

See LICENSE file for details.