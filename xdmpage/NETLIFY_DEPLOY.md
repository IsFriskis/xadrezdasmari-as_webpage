# Deploying to Netlify

## Quick Deploy

### Option 1: Connect GitHub Repository (Recommended)

1. **Push your code to GitHub:**
   ```powershell
   git add .
   git commit -m "Add Netlify configuration"
   git push origin main
   ```

2. **Go to [Netlify](https://app.netlify.com/)**
   - Click "Add new site" → "Import an existing project"
   - Choose "GitHub" and authorize Netlify
   - Select your repository: `IsFriskis/xadrezdasmari-as_webpage`
   - Configure build settings:
     - **Base directory:** `xdmpage`
     - **Build command:** `npm run build`
     - **Publish directory:** `xdmpage/dist`

3. **Click "Deploy site"**

### Option 2: Netlify CLI

```powershell
# Install Netlify CLI globally
npm install -g netlify-cli

# Login to Netlify
netlify login

# Initialize and deploy
netlify init

# Or deploy manually
netlify deploy --prod
```

## Enable Decap CMS Authentication

After your site is deployed:

### Step 1: Enable Netlify Identity

1. Go to your site dashboard on Netlify
2. Navigate to **Site settings** → **Identity**
3. Click **"Enable Identity"**

### Step 2: Enable Git Gateway

1. In Identity settings, scroll down to **Services**
2. Click **"Enable Git Gateway"**
3. This allows Decap CMS to commit directly to your GitHub repository

### Step 3: Configure Registration

1. In Identity settings, under **Registration preferences**
2. Choose **"Invite only"** (recommended for admin access)

### Step 4: Invite Admin Users

1. Go to the **Identity** tab in your site dashboard
2. Click **"Invite users"**
3. Enter email addresses for your admins
4. They'll receive an email to set up their account

### Step 5: Access Admin Panel

- Visit: `https://your-site-name.netlify.app/admin/`
- Log in with Netlify Identity credentials
- Start managing content!

## Environment Variables (Optional)

If you need any environment variables:

1. Go to **Site settings** → **Environment variables**
2. Add your variables (e.g., API keys, etc.)

## Custom Domain

1. Go to **Domain settings**
2. Add your custom domain: `xadrezdasmarinas.org`
3. Follow Netlify's DNS configuration instructions
4. Enable HTTPS (automatic with Netlify)

## Continuous Deployment

Once connected, Netlify will automatically:
- ✅ Deploy on every push to `main` branch
- ✅ Build preview deployments for pull requests
- ✅ Show build logs and status
- ✅ Provide instant rollback if needed

## Local Testing

Before deploying, test the build locally:

```powershell
# Build for production
npm run build

# Preview the build
npm run preview
```

## Troubleshooting

### Build fails
- Check Node version is 20.x in `netlify.toml`
- Verify `package.json` scripts are correct
- Check build logs in Netlify dashboard

### CMS not loading
- Ensure Identity is enabled
- Check that Git Gateway is enabled
- Verify `config.yml` has correct repo name

### Authentication issues
- Clear browser cache
- Check that users are invited in Identity tab
- Verify email confirmation was completed

## Build Settings in netlify.toml

The `netlify.toml` file includes:
- ✅ Build command and publish directory
- ✅ Security headers
- ✅ Cache control for static assets
- ✅ Redirect rules
- ✅ Node.js version

Everything is configured and ready to deploy! 🚀
