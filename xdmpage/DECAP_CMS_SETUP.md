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

Decap CMS is configured to work with **Netlify Identity + Git Gateway**.

#### Setup Steps for Netlify:

1. **Enable Netlify Identity:**
   - Go to your Netlify site dashboard
   - Navigate to **Site settings** → **Identity**
   - Click **Enable Identity**

2. **Enable Git Gateway:**
   - In the Identity section, go to **Services** → **Git Gateway**
   - Click **Enable Git Gateway**
   - This allows Decap CMS to commit directly to your GitHub repo

3. **Invite yourself as a user:**
   - Go to **Identity** tab in your Netlify dashboard
   - Click **Invite users**
   - Enter your email
   - Check your email and accept the invitation
   - Set your password

4. **Access the admin panel:**
   - Visit `https://yoursite.netlify.app/admin/`
   - Click "Login with Netlify Identity"
   - Use your email and password

**Alternative: Use GitHub OAuth (Any hosting provider)**
- Create a GitHub OAuth app
- Use an OAuth provider like [netlify-cms-github-oauth-provider](https://github.com/vencax/netlify-cms-github-oauth-provider)
- Update config.yml to use GitHub backend with your OAuth endpoint

## � How to Create Blog Posts

### Using Decap CMS (Production):

1. **Access the admin panel:**
   - Go to `https://xdmwebpage.netlify.app/admin/`
   - Login with your Netlify Identity credentials

2. **Create a new post:**
   - Click on **"Blog Posts"** in the Collections menu
   - Click the **"New Blog Posts"** button (top right)
   
3. **Fill in the fields:**
   - **Título**: Main title of your blog post
   - **Descrición**: Short summary (2-3 sentences) that appears on blog cards
   - **Data de Publicación**: Select the publish date and time
   - **Imaxe** (optional): Click "Choose different image" to upload a featured image
   - **Contido**: Write your full blog post content using Markdown
   
4. **Preview and publish:**
   - Use the preview button to see how it looks
   - Click **"Publish"** dropdown → **"Publish now"** when ready
   - Your post will be committed to GitHub and deployed automatically!

### Using Local Development:

1. Start both servers:
   ```powershell
   # Terminal 1
   npm run dev
   
   # Terminal 2
   npx decap-server
   ```

2. Access `http://localhost:4321/admin/`
3. No login required - edit directly!

### Tips:
- Images should be JPG, PNG, or WebP format
- Keep descriptions concise (150-200 characters)
- Use Markdown for formatting: `**bold**`, `*italic*`, `# Heading`
- Posts appear automatically on the blog page sorted by date

## �🔧 Current Configuration

### Backend
- **Type:** Git Gateway (Netlify Identity)
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
