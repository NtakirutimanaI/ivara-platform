{{-- Language Selector Component --}}
<div class="language-selector-wrapper">
    <button class="language-selector-btn" id="languageSelectorBtn" title="{{ __('messages.select_language') }}">
        <i class="fas fa-globe"></i>
        <span class="current-lang" id="currentLangDisplay">{{ strtoupper(app()->getLocale()) }}</span>
        <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 5px;"></i>
    </button>
    <div class="language-dropdown" id="languageDropdown">
        <div class="lang-option {{ app()->getLocale() === 'en' ? 'active' : '' }}" data-locale="en">
            <span class="lang-flag">🇬🇧</span>
            <span class="lang-name">English</span>
        </div>
        <div class="lang-option {{ app()->getLocale() === 'rw' ? 'active' : '' }}" data-locale="rw">
            <span class="lang-flag">🇷🇼</span>
            <span class="lang-name">Kinyarwanda</span>
        </div>
        <div class="lang-option {{ app()->getLocale() === 'sw' ? 'active' : '' }}" data-locale="sw">
            <span class="lang-flag">🇹🇿</span>
            <span class="lang-name">Kiswahili</span>
        </div>
        <div class="lang-option {{ app()->getLocale() === 'fr' ? 'active' : '' }}" data-locale="fr">
            <span class="lang-flag">🇫🇷</span>
            <span class="lang-name">Français</span>
        </div>
    </div>
</div>

<style>
    /* Language Selector Styles */
    .language-selector-wrapper {
        position: relative;
    }

    .language-selector-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: #0A1128;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .language-selector-btn:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: #FFB600;
        transform: translateY(-2px);
    }

    .language-selector-btn .fa-globe {
        font-size: 16px;
        color: #FFB600;
    }

    .current-lang {
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .language-dropdown {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        min-width: 160px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        padding: 4px;
        display: none;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 3000;
    }

    .language-dropdown.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .lang-option {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .lang-option:hover {
        background: #f8fafc;
    }

    .lang-option.active {
        background: linear-gradient(135deg, #FFB600 0%, #FFA000 100%);
        color: #fff;
    }

    .lang-option.active .lang-name {
        font-weight: 700;
    }

    .lang-flag {
        font-size: 18px;
        line-height: 1;
        width: 24px;
        text-align: center;
    }

    .lang-name {
        font-size: 13px;
        font-weight: 500;
    }

    /* Dark mode support */
    body.dark-theme .language-selector-btn {
        color: #f1f5f9;
        border-color: rgba(255, 255, 255, 0.1);
    }

    body.dark-theme .language-selector-btn:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    body.dark-theme .language-dropdown {
        background: #1e293b;
        border-color: rgba(255, 255, 255, 0.1);
    }

    body.dark-theme .lang-option:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    body.dark-theme .lang-option:not(.active) .lang-name {
        color: #cbd5e1;
    }

    /* Dashboard Header Specific Styles */
    .ivara-header .language-selector-btn {
        width: 44px;
        height: 44px;
        padding: 0;
        border-radius: 12px;
        background: transparent;
        border: 1px solid transparent;
        color: var(--h-text);
        justify-content: center;
    }

    .ivara-header .language-selector-btn:hover {
        background: rgba(0,0,0,0.05);
        border-color: var(--h-border);
        color: var(--h-primary);
        transform: none;
    }

    .ivara-header .language-selector-btn .fa-globe {
        color: var(--h-text);
    }

    .ivara-header .language-selector-btn:hover .fa-globe {
        color: var(--h-primary);
    }

    .ivara-header .language-selector-btn .current-lang {
        display: none; /* Hide language code in dashboard, show only globe */
    }

    .ivara-header .language-selector-btn .fa-chevron-down {
        display: none; /* Hide chevron in dashboard */
    }
</style>

<script>
    // Prevent duplicate initialization
    if (!window.languageSelectorInitialized) {
        window.languageSelectorInitialized = true;
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Language selector initializing...');
            
            const langBtn = document.getElementById('languageSelectorBtn');
            const langDropdown = document.getElementById('languageDropdown');
            const langOptions = document.querySelectorAll('.lang-option');
            const currentLangDisplay = document.getElementById('currentLangDisplay');

            console.log('Language selector elements:', {
                langBtn: langBtn,
                langDropdown: langDropdown,
                langOptionsCount: langOptions.length
            });

            // Toggle dropdown
            if (langBtn && langDropdown) {
                console.log('Adding click listener to language button');
                
                langBtn.addEventListener('click', function(e) {
                    console.log('Language button clicked!');
                    e.stopPropagation();
                    langDropdown.classList.toggle('show');
                    console.log('Dropdown show class:', langDropdown.classList.contains('show'));
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function() {
                    langDropdown.classList.remove('show');
                });

                langDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            } else {
                console.error('Language selector elements not found!', {
                    langBtn: langBtn,
                    langDropdown: langDropdown
                });
            }

            // Handle language selection
            langOptions.forEach(option => {
                option.addEventListener('click', function() {
                    const locale = this.getAttribute('data-locale');
                    console.log('Language selected:', locale);
                    
                    // Show loading state
                    langBtn.disabled = true;
                    langBtn.style.opacity = '0.6';

                    // Send language change request
                    fetch('{{ route("language.switch") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ locale: locale })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Language switch response:', data);
                        if (data.success) {
                            // Update display
                            currentLangDisplay.textContent = locale.toUpperCase();
                            
                            // Reload page to apply new language
                            window.location.reload();
                        } else {
                            console.error('Language switch failed:', data.message);
                            langBtn.disabled = false;
                            langBtn.style.opacity = '1';
                        }
                    })
                    .catch(error => {
                        console.error('Error switching language:', error);
                        langBtn.disabled = false;
                        langBtn.style.opacity = '1';
                    });

                    // Close dropdown
                    langDropdown.classList.remove('show');
                });
            });
        });
    }
</script>

