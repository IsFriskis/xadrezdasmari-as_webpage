# Prismic CMS Integration Guide

This guide explains how to integrate Prismic CMS with the Xadrez das Mariñas blog.

## Overview

The blog system now supports content management through Prismic CMS while maintaining backward compatibility with local markdown files. If Prismic is not configured, the system automatically falls back to the local content collection.

## Prerequisites

1. A Prismic account (sign up at [prismic.io](https://prismic.io))
2. A Prismic repository created for your project

## Setup Steps

### 1. Create a Prismic Repository

1. Log in to [Prismic](https://prismic.io)
2. Create a new repository or use an existing one
3. Note your repository name (e.g., "xadrezdasmarinas")

### 2. Configure Environment Variables

Create a `.env` file in the `xdmpage` directory:

```bash
cp .env.example .env
```

Edit `.env` and set your Prismic repository name:

```env
PUBLIC_PRISMIC_REPOSITORY=your-repository-name
```

### 3. Create Custom Type in Prismic

In your Prismic repository, create a new Custom Type called `blog_post` with the following fields:

#### JSON Definition

```json
{
  "Main": {
    "title": {
      "type": "Text",
      "config": {
        "label": "Title",
        "placeholder": "Blog post title"
      }
    },
    "description": {
      "type": "Text",
      "config": {
        "label": "Description",
        "placeholder": "Brief description of the blog post"
      }
    },
    "featured_image": {
      "type": "Image",
      "config": {
        "label": "Featured Image",
        "constraint": {},
        "thumbnails": []
      }
    },
    "content": {
      "type": "StructuredText",
      "config": {
        "label": "Content",
        "placeholder": "Write your blog post content here...",
        "allowTargetBlank": true,
        "multi": "paragraph,preformatted,heading1,heading2,heading3,heading4,heading5,heading6,strong,em,hyperlink,image,embed,list-item,o-list-item,rtl"
      }
    }
  }
}
```

#### Field Descriptions

- **title** (Text): The title of the blog post
- **description** (Text): A brief description shown in the blog listing
- **featured_image** (Image): Optional featured image for the blog post
- **content** (Rich Text): The main content of the blog post

### 4. Create Blog Posts

1. In your Prismic dashboard, go to Documents
2. Create new documents of type "blog_post"
3. Fill in the required fields:
   - Title
   - Description
   - Featured Image (optional)
   - Content
4. Set a UID for each post (this will be used in the URL)
5. Publish your posts

### 5. Build and Deploy

```bash
npm run build
```

The blog will now fetch content from Prismic. If Prismic is unavailable or not configured, it will automatically fall back to local markdown files.

## Features

- **Automatic Fallback**: If Prismic is not configured or unavailable, the blog uses local markdown files
- **Rich Text Support**: Full support for Prismic's rich text formatting
- **Image Support**: Featured images from Prismic are automatically displayed
- **Date Sorting**: Posts are automatically sorted by publication date (newest first)
- **SEO Friendly**: Proper meta tags and descriptions

## Content Management

### Using Prismic (Recommended for Production)

1. Log in to your Prismic dashboard
2. Create/edit blog posts using the visual editor
3. Publish changes
4. Rebuild and deploy your site

### Using Local Files (Development/Fallback)

Blog posts are stored in `src/content/blog/` as markdown files with frontmatter:

```markdown
---
title: "Your Blog Post Title"
description: "A brief description"
date: 2024-11-01
image: "/images/featured-image.jpg"
---

Your blog post content here...
```

## Troubleshooting

### Posts Not Appearing

1. Verify your `PUBLIC_PRISMIC_REPOSITORY` environment variable is set correctly
2. Ensure your blog posts are published in Prismic
3. Check that the custom type is named exactly `blog_post`
4. Verify all required fields (title, description, content) are filled

### Build Errors

If you see Prismic-related errors during build:
- The system will automatically fall back to local content
- Check the console for specific error messages
- Verify your Prismic repository is accessible

### Content Not Updating

1. Clear your build cache: `rm -rf dist`
2. Rebuild: `npm run build`
3. Remember that Astro generates static pages, so you need to rebuild to see Prismic changes

## Migration from Local to Prismic

If you want to migrate existing markdown content to Prismic:

1. For each markdown file in `src/content/blog/`:
2. Create a corresponding blog_post document in Prismic
3. Copy the title, description, and content
4. Set the UID to match the markdown filename (without .md)
5. Publish the document

Once all content is migrated, the system will automatically use Prismic content instead of local files.

## API Reference

### Prismic Client

The Prismic client is configured in `src/lib/prismicio.ts`:

```typescript
import { createClient } from '../lib/prismicio';

const client = createClient();
const posts = await client.getAllByType('blog_post');
```

### Environment Variables

- `PUBLIC_PRISMIC_REPOSITORY`: Your Prismic repository name (default: "xadrezdasmarinas")

## Additional Resources

- [Prismic Documentation](https://prismic.io/docs)
- [Prismic Custom Types](https://prismic.io/docs/custom-types)
- [Prismic Rich Text](https://prismic.io/docs/rich-text-title)
- [Astro Content Collections](https://docs.astro.build/en/guides/content-collections/)
