# Decap CMS Admin Setup

## ✅ Setup Complete

The Decap CMS admin interface is now configured at `/admin`.

**No, you DON'T need Netlify!** Decap CMS works with any hosting provider.

## 📂 Files Created/Updated

1. **`public/admin/index.html`** - Main Decap CMS interface
2. **`public/admin/config.yml`** - CMS configuration with GitHub backend
3. **`src/pages/admin.astro`** - Redirect page for cleaner URLs

## 🚀 How to Use

### Local Development (No Authentication Required)

1. **Start the dev server:**
   ```powershell
   npm run dev
   ```

2. **In a separate terminal, start the local backend:**
   ```powershell
   npx decap-server
   ```

3. **Access the admin panel:**
   - Navigate to `http://localhost:4321/admin/`
   - No login required in local mode!
   - Edit content directly, changes are saved to your local files

### Production Deployment

Decap CMS works with **any hosting provider**:
- ✅ **Vercel** (recommended)
- ✅ **Netlify**
- ✅ **GitHub Pages**
- ✅ **Cloudflare Pages**
- ✅ **Any static host**

#### Authentication Options:

**Option 1: GitHub OAuth (Recommended)**
- Uses GitHub authentication
- Free for public repos
- Works with any hosting provider
- Setup: Create GitHub OAuth app in your repo settings

**Option 2: Netlify Identity (if using Netlify)**
- Enable in Netlify dashboard
- Good for non-technical users

**Option 3: Git Gateway (Netlify only)**
- Easiest for Netlify users
- Built-in authentication

**Option 4: External OAuth Providers**
- GitLab, Bitbucket, etc.
- Requires OAuth setup

## 🔧 Current Configuration

### Backend
- **Type:** GitHub
- **Repository:** IsFriskis/xadrezdasmari-as_webpage
- **Branch:** main
- **Local backend:** Enabled for development

### Collections
- **Blog Posts** (`src/content/blog/`)
  - Title (string)
  - Description (text)
  - Publish Date (datetime)
  - Image (optional)
  - Body (markdown)

### Media
- **Upload folder:** `public/images/uploads/`
- **Public path:** `/images/uploads/`

## � Quick Start (Local)

```powershell
# Terminal 1 - Start Astro dev server
npm run dev

# Terminal 2 - Start Decap CMS local backend
npx decap-server
```

Then visit: `http://localhost:4321/admin/`

## 🌐 Deploy Anywhere

Your site can be deployed to any static hosting:

```powershell
# Build for production
npm run build

# Preview build
npm run preview
```

The admin interface works wherever you deploy!
