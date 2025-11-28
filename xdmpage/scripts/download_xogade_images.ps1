# Download selected Xogade images into public/images/xogade/
# Usage: Open PowerShell in the `xdmpage` folder and run: `./scripts/download_xogade_images.ps1`

$targetDir = "public/images/xogade"
if (!(Test-Path $targetDir)) {
  New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
}
# Crawl the club site and extract blogger-hosted image URLs, then download them
$blogUrl = 'https://www.xn--xadrezdasmarias-brb.org/'
Write-Host "Fetching blog homepage: $blogUrl"
try {
  $html = (Invoke-WebRequest -Uri $blogUrl -UseBasicParsing -ErrorAction Stop).Content
} catch {
  Write-Warning "Failed to fetch $blogUrl : $_"
  $html = ''
}

# Regex to extract blogger-hosted images (stop at whitespace or double-quote)
$imgRegex = 'https://blogger\.googleusercontent\.com/img/[^\s"]+'

$matches = @()
if ($html) {
  $matches = [regex]::Matches($html, $imgRegex) | ForEach-Object { $_.Value } | Select-Object -Unique
}

if (-not $matches -or $matches.Count -eq 0) {
  Write-Host "No blogger images found on homepage; falling back to default list."
  $matches = @(
    "https://blogger.googleusercontent.com/img/a/AVvXsEjW74XuCjvTDFSD7kdJp8RVqz_DkOiGr1PO3VMvQiAD8qcex8B6GjfMsELB8PE7Azi-OlL29dqeVBk9okK46n98_xrI0bF6ssX06nPdwHplbYyJ8RxHd2z32ErBJhk9Sk5GngxmTTNTbtXgQSPQcusS3NZSqsK7UmdVSXx6X_htaTnLRv6YfD3VA7UVHM8y=s195",
    "https://blogger.googleusercontent.com/img/a/AVvXsEgBc2i0S-ZiuRExMSvIga8QnsnkPNvQ26W6xnFhsykH-XN6u2yBc2wqfmbP4An5oK3cVLsYlYKyykA2pqRJgoHM5a61q_WcQ28DybndVU1rbKMngF7n4raUtBR5jEDp1eV1VPSHCuATX6MeYFIgdUZuYe4METOluimfRS5WLTRn_QMiJbgc_vdpS8IP4N3i=s195",
    "https://blogger.googleusercontent.com/img/a/AVvXsEg_3LHBR7KgEUUQVeJ7xpqFTITYUA03PNrwZIcNv67VVi2hZk0Z3o-EWaydpWPcuLSva7U1Ts5wLueloyEKp-5exWL4Px5jOmjAELUPNtosbZVY9_qj-CXOgh2wJkk6SnCp4r8H5NqdmukYfnTcfkFr0BNPSZsUnOPtNnvQkD2hhvOq4ClrIK-l6Q4eoOwP=s195"
  )
}

Write-Host "Found $($matches.Count) unique blogger image URLs."

# Download and rename with friendly names
$i = 1
$downloaded = @()
foreach ($url in $matches) {
  try {
    $out = Join-Path $targetDir ("xogade-$i.jpg")
    Invoke-WebRequest -Uri $url -OutFile $out -UseBasicParsing -ErrorAction Stop
    Write-Host "Saved -> $out"
    $downloaded += $out
    $i++
  } catch {
    Write-Warning "Failed to download $url : $_"
  }
}

if ($downloaded.Count -eq 0) {
  Write-Warning "No images downloaded. Exiting."
  return
}

# Generate gallery HTML snippet
$galleryHtml = '<div class="gallery">' + "`n"
foreach ($f in $downloaded) {
  $name = [System.IO.Path]::GetFileName($f)
  $galleryHtml += '  <img src="/images/xogade/' + $name + '" alt="Xogade image" />' + "`n"
}
$galleryHtml += '</div>' + "`n"

# Inject gallery into the page between markers
$pagePath = 'src/pages/xogade.astro'
if (Test-Path $pagePath) {
  $page = Get-Content -Raw -Path $pagePath
  $start = '<!-- GALLERY-START -->'
  $end = '<!-- GALLERY-END -->'
  if ($page -match [regex]::Escape($start) -and $page -match [regex]::Escape($end)) {
    $pattern = [regex]::Escape($start) + '.*?' + [regex]::Escape($end)
    $replacement = $start + "`n" + $galleryHtml + "        " + $end
    $new = [regex]::Replace($page, $pattern, $replacement, [System.Text.RegularExpressions.RegexOptions]::Singleline)
    Set-Content -Path $pagePath -Value $new -Force
    Write-Host "Updated $pagePath with $($downloaded.Count) local images."
  } else {
    Write-Warning "Markers not found in $pagePath; skipping injection."
  }
} else {
  Write-Warning "$pagePath not found; skipping page update."
}

Write-Host "Done. Page updated for production (local images used in gallery)."