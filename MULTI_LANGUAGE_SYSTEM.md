# Multi-Language System Implementation

## Overview
The IVARA platform now supports 4 languages:
- **English (en)** - Default
- **Kinyarwanda (rw)** - Rwanda
- **Kiswahili (sw)** - Tanzania/East Africa
- **Français (fr)** - French

## Frontend (Laravel)

### Language Files Location
```
ivara-frontend/lang/
├── en/messages.php
├── rw/messages.php
├── sw/messages.php
└── fr/messages.php
```

### Using Translations in Blade Templates
```blade
{{-- Simple translation --}}
{{ __('messages.sign_in') }}

{{-- Translation with parameters --}}
{{ __('messages.welcome', ['name' => $user->name]) }}
```

### Language Selector Component
The language selector is located at:
```
resources/views/components/language-selector.blade.php
```

It's included in the header and displays:
- Globe icon
- Current language code (EN, RW, SW, FR)
- Dropdown with all available languages
- Flag emojis for visual identification

### How Language Switching Works
1. User clicks on language selector
2. Selects desired language from dropdown
3. AJAX request sent to `/language/switch` endpoint
4. Language stored in session
5. Page reloads with new language

### Adding New Translations
To add new translation keys:

1. Open all language files in `lang/` directory
2. Add the same key to each file with appropriate translation:

```php
// lang/en/messages.php
'new_key' => 'English text',

// lang/rw/messages.php
'new_key' => 'Kinyarwanda text',

// lang/sw/messages.php
'new_key' => 'Kiswahili text',

// lang/fr/messages.php
'new_key' => 'French text',
```

3. Use in templates:
```blade
{{ __('messages.new_key') }}
```

## Backend (Node.js/TypeScript)

### Translation Service
Location: `backend-microservice/src/services/translationService.ts`

The translation service provides:
- Automatic object field translation
- Array translation
- Locale validation
- Request locale detection

### Translation Middleware
Location: `backend-microservice/src/middleware/translationMiddleware.ts`

Automatically applied to all API routes. It:
- Detects locale from query parameter or Accept-Language header
- Translates response data automatically
- Handles nested objects and arrays

### Using Translations in API Responses

#### Automatic Translation
The middleware automatically translates fields that have translation objects:

```typescript
// In your MongoDB document
{
  name: {
    en: "Technical Repair",
    rw: "Gusana Tekiniki",
    sw: "Ukarabati wa Kiufundi",
    fr: "Réparation Technique"
  },
  description: {
    en: "Professional repair services",
    rw: "Serivisi zo gusana z'umwuga",
    sw: "Huduma za ukarabati wa kitaalamu",
    fr: "Services de réparation professionnels"
  }
}

// API Response (when locale=rw)
{
  name: "Gusana Tekiniki",
  description: "Serivisi zo gusana z'umwuga"
}
```

#### Manual Translation
```typescript
import translationService from '../services/translationService';

// In your controller
const locale = (req as any).locale || 'en';
const translatedData = translationService.translateObject(data, locale);
```

### API Request Examples

#### Using Query Parameter
```
GET /api/products?locale=rw
GET /api/categories?locale=sw
```

#### Using Accept-Language Header
```
GET /api/products
Headers: Accept-Language: rw
```

### Adding Backend Translations

1. Open `backend-microservice/src/services/translationService.ts`
2. Add to the `translations` object:

```typescript
'your.key': {
  en: 'English text',
  rw: 'Kinyarwanda text',
  sw: 'Kiswahili text',
  fr: 'French text'
}
```

3. Use in responses:
```typescript
const message = translationService.translate('your.key', locale);
```

## Database Schema for Multilingual Content

### Recommended Structure
For any field that needs translation, use an object with language keys:

```javascript
// MongoDB Schema Example
const ProductSchema = new Schema({
  name: {
    en: { type: String, required: true },
    rw: { type: String },
    sw: { type: String },
    fr: { type: String }
  },
  description: {
    en: { type: String, required: true },
    rw: { type: String },
    sw: { type: String },
    fr: { type: String }
  },
  price: { type: Number, required: true }, // Numbers don't need translation
  category: { type: String, required: true }
});
```

### Best Practices
1. **Always provide English (en)** - It's the fallback language
2. **Use consistent keys** - Same structure across all translatable fields
3. **Validate on input** - Ensure at least English is provided
4. **Graceful fallback** - If a translation is missing, show English

## Testing the Multi-Language System

### Frontend Testing
1. Open the landing page
2. Click the language selector (globe icon) in the header
3. Select a different language
4. Verify:
   - Page reloads
   - UI text changes to selected language
   - Language selector shows correct current language

### Backend Testing
```bash
# Test with query parameter
curl "http://localhost:5001/api/products?locale=rw"

# Test with header
curl -H "Accept-Language: sw" "http://localhost:5001/api/products"
```

### Expected Behavior
- All translatable fields should be in the selected language
- Non-translatable fields (numbers, IDs) remain unchanged
- Missing translations fall back to English

## Troubleshooting

### Language not changing
1. Check browser console for errors
2. Verify session is working (check cookies)
3. Clear browser cache
4. Check Laravel logs: `storage/logs/laravel.log`

### Translations not showing
1. Verify translation key exists in all language files
2. Check file permissions on `lang/` directory
3. Clear Laravel cache: `php artisan cache:clear`
4. Clear view cache: `php artisan view:clear`

### Backend translations not working
1. Check if translation middleware is loaded
2. Verify locale is being detected (check request object)
3. Ensure MongoDB documents have translation objects
4. Check backend console for errors

## Future Enhancements

### Planned Features
1. **Admin panel for translations** - Manage translations without editing files
2. **User language preference** - Save user's preferred language in database
3. **RTL support** - For Arabic and other RTL languages
4. **Translation memory** - Reuse common translations
5. **Machine translation fallback** - Auto-translate missing translations

### Adding More Languages
To add a new language (e.g., Spanish):

1. Create language directory:
```bash
mkdir lang/es
```

2. Create messages file:
```bash
cp lang/en/messages.php lang/es/messages.php
```

3. Translate all strings in `lang/es/messages.php`

4. Update `LanguageController.php`:
```php
$availableLocales = ['en', 'rw', 'sw', 'fr', 'es'];
```

5. Update language selector component to include Spanish

6. Update backend `translationService.ts`:
```typescript
getSupportedLocales(): string[] {
  return ['en', 'rw', 'sw', 'fr', 'es'];
}
```

## Support

For issues or questions about the multi-language system:
1. Check this documentation
2. Review the code comments
3. Test with different languages
4. Check browser and server logs

---

**Last Updated:** December 30, 2025
**Version:** 1.0.0
