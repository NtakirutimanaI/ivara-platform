# Language Selector Debugging Guide

## Issue Fixed
**Problem**: Language selector button not opening dropdown when clicked
**Root Cause**: HTML entity encoding in JavaScript (`&amp;&amp;` instead of `&&`)
**Solution**: Fixed HTML entities and added debugging console logs

## Changes Made

### 1. Fixed HTML Entity Encoding
- Replaced `&amp;&amp;` with `&&` in JavaScript
- Replaced `&amp;` with `&` throughout the file

### 2. Added Singleton Pattern
- Prevents duplicate initialization when component is included multiple times
- Uses `window.languageSelectorInitialized` flag

### 3. Added Console Logging
The language selector now logs to browser console:
- "Language selector initializing..." - When script starts
- Element detection status
- "Language button clicked!" - When button is clicked
- "Dropdown show class: true/false" - Dropdown state
- "Language selected: XX" - When language is chosen
- Error messages if elements not found

## Testing Instructions

### 1. Open Browser Console
1. Visit `http://localhost:8000`
2. Press `F12` to open Developer Tools
3. Go to "Console" tab

### 2. Check for Initialization
You should see:
```
Language selector initializing...
Language selector elements: {langBtn: button#languageSelectorBtn, langDropdown: div#languageDropdown, langOptionsCount: 4}
Adding click listener to language button
```

### 3. Click Language Button
When you click the globe icon (🌐), you should see:
```
Language button clicked!
Dropdown show class: true
```

### 4. Check Dropdown Visibility
- The dropdown should appear below the button
- Should show 4 languages with flags
- Active language should be highlighted

### 5. Select a Language
When you click a language option, you should see:
```
Language selected: rw (or en, sw, fr)
Language switch response: {success: true, locale: "rw", message: "Language changed successfully"}
```
Then the page should reload.

## Troubleshooting

### If you see "Language selector elements not found!"
**Problem**: HTML elements missing
**Check**:
1. View page source (Ctrl+U)
2. Search for `id="languageSelectorBtn"`
3. Search for `id="languageDropdown"`
4. Verify both exist in the HTML

### If button click doesn't log anything
**Problem**: JavaScript not running
**Check**:
1. Browser console for JavaScript errors
2. Verify `<script>` tag is present in page source
3. Check if there are multiple language selectors (should only initialize once)

### If dropdown doesn't show
**Problem**: CSS issue
**Check**:
1. Inspect the dropdown element
2. Verify it has `class="language-dropdown show"` when clicked
3. Check CSS styles are loaded
4. Look for `display: block` and `opacity: 1` in computed styles

### If language doesn't change
**Problem**: API endpoint issue
**Check**:
1. Network tab in Developer Tools
2. Look for POST request to `/language/switch`
3. Check response status (should be 200)
4. Verify CSRF token is present

## Expected Behavior

### Landing Page
- Globe icon with language code (EN, RW, SW, FR)
- Full button with border
- Dropdown shows on click

### Dashboard
- Globe icon only (no text)
- Compact 44x44px button
- Matches other header icons
- Same dropdown functionality

## Quick Fix Commands

If issues persist, run these commands:

```bash
# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear

# Check routes
php artisan route:list | grep language

# Test API endpoint
curl -X POST http://localhost:8000/language/switch \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: your-token-here" \
  -d '{"locale":"rw"}'
```

## File Locations

- Component: `resources/views/components/language-selector.blade.php`
- Controller: `app/Http/Controllers/LanguageController.php`
- Middleware: `app/Http/Middleware/SetLocale.php`
- Routes: `routes/web.php` (lines 124-126)
- Translations: `lang/*/messages.php`

## Success Indicators

✅ Console shows initialization messages
✅ Button click logs to console
✅ Dropdown appears with 4 languages
✅ Active language is highlighted
✅ Clicking language triggers API call
✅ Page reloads after selection
✅ UI text changes to selected language

---

**Last Updated**: December 30, 2025, 9:38 PM
**Status**: Fixed and ready for testing
