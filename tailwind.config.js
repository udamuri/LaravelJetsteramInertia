const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    //darkMode: 'class', // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            zIndex: {
                '-1': '-1'
            },
            flexGrow: {
                5: '5'
            },
            maxHeight: {
                'screen-menu': 'calc(100vh - 3.5rem)',
                modal: 'calc(100vh - 160px)'
            },
            transitionProperty: {
                position: 'right, left, top, bottom, margin, padding',
                textColor: 'color'
            },
            keyframes: {
                fadeOut: {
                    from: { opacity: 1 },
                    to: { opacity: 0 }
                },
                fadeIn: {
                    from: { opacity: 0 },
                    to: { opacity: 1 }
                }
            },
            animation: {
                fadeOut: 'fadeOut 250ms ease-in-out',
                fadeIn: 'fadeIn 250ms ease-in-out'
            }
        },
    },
    variants: {
        extend: {
            margin: ['last'],
            fontWeight: ['last'],
            textColor: ['last'],
            borderWidth: ['dark']
        },
        scrollbar: ['dark', 'rounded']
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('tailwind-scrollbar'),
        require('@tailwindcss/typography')
    ]
};