#!/bin/bash

# Quick Start Script for xdmpayload project
# This script helps you quickly set up and run the project

set -e

echo "==================================="
echo "Xadrez das Mariñas - PayloadCMS + Astro"
echo "==================================="
echo ""

# Check if MongoDB is required
echo "📦 Checking dependencies..."

# Check for Node.js
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js v18.20.2+ or v20.9.0+"
    exit 1
fi

echo "✅ Node.js version: $(node --version)"

# Check for npm
if ! command -v npm &> /dev/null; then
    echo "❌ npm is not installed. Please install npm"
    exit 1
fi

echo "✅ npm version: $(npm --version)"

# Check if .env exists
if [ ! -f .env ]; then
    echo ""
    echo "⚠️  .env file not found. Creating from .env.example..."
    cp .env.example .env
    echo "✅ .env file created. Please configure DATABASE_URI and PAYLOAD_SECRET in .env"
    echo ""
    echo "For quick start with local MongoDB:"
    echo "  DATABASE_URI=mongodb://127.0.0.1/xdmpayload"
    echo ""
fi

# Check if node_modules exists
if [ ! -d "node_modules" ]; then
    echo ""
    echo "📦 Installing PayloadCMS dependencies..."
    npm install
    echo "✅ PayloadCMS dependencies installed"
fi

# Check frontend node_modules
if [ ! -d "frontend/node_modules" ]; then
    echo ""
    echo "📦 Installing Astro frontend dependencies..."
    cd frontend
    npm install
    cd ..
    echo "✅ Astro frontend dependencies installed"
fi

echo ""
echo "==================================="
echo "✅ Setup complete!"
echo "==================================="
echo ""
echo "To start the project:"
echo ""
echo "1. Start MongoDB (if not running):"
echo "   docker-compose up -d"
echo "   OR ensure MongoDB is running locally"
echo ""
echo "2. Start PayloadCMS backend:"
echo "   npm run dev"
echo "   Access admin panel at: http://localhost:3000/admin"
echo ""
echo "3. In a new terminal, start Astro frontend:"
echo "   cd frontend && npm run dev"
echo "   Access website at: http://localhost:4321"
echo ""
echo "==================================="
