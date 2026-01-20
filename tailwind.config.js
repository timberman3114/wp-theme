/** @type {import('tailwindcss').Config} */
import colors from 'tailwindcss/colors'

export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.php",
    "./assets/ts/**/*.ts",
    "./**/*.php",
  ],
  theme: {
    container: {
      center: true,
      padding: {
        '2xl': '80px',
      },
      screens: {
        '2xl': '1440px',
      },
    },
    extend: {
      fontFamily: {
        'inter': ['Inter', 'sans-serif'],
        'roboto': ['Roboto', 'sans-serif'],
        'orbitron': ['Orbitron', 'sans-serif'],
        'nunito': ['Nunito', 'sans-serif'],
      },
      colors: {
        // Full palettes for utility variants like -300/-600
        primary: colors.indigo,
        secondary: colors.sky,
        
        // Single-value tokens
        light_primary: '#18202F',
        border: '#1F2937',
        dark_screen: '#1a2530',
        screen_border: '#2c3e50',
        green: '#2ecc71',
        blue: '#3498db',
        red: '#e74c3c',
        orange: '#f39c12',
        light_gray: '#9CA3AF',
        bg_section: '#0c1322',
        box_bg: '#10192d',
        box_border: '#182543',
        box_icon: '#182e55',
      },
      fontSize: {
        'xs': ['0.75rem', { lineHeight: '1rem' }],        // 12px / 16px
        'sm': ['0.875rem', { lineHeight: '1.25rem' }],    // 14px / 20px
        'base': ['1rem', { lineHeight: '1.5rem' }],       // 16px / 24px
        'lg': ['1.125rem', { lineHeight: '1.75rem' }],    // 18px / 28px
        'xl': ['1.25rem', { lineHeight: '1.75rem' }],     // 20px / 28px
        '2xl': ['1.5rem', { lineHeight: '2rem' }],        // 24px / 32px
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],   // 30px / 36px
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],     // 36px / 40px
        '5xl': ['3rem', { lineHeight: '1.16' }],          // 48px / 1.16
        'display': ['3.75rem', { lineHeight: '1.12' }],   // 60px / 1.12
        'giant': ['4.5rem', { lineHeight: '1.08' }],      // 72px / 1.08
      },
      screens: {
        'sm2': '471px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
      },
      maxWidth: {
        'reading': '65ch',
        'container': '1440px',
      },
      spacing: {
        'section': '6rem',
        'header': '5rem',
      },
      borderRadius: {
        'primary': '0.375rem',
        'secondary': '0.5rem',
        'large': '1rem',
      },
      boxShadow: {
        'dropdown': '0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.1)',
        'card': '0px 4px 6px 0px rgba(0, 0, 0, .1), 0px 10px 15px 0px rgba(0, 0, 0, .1)',
      },
    },
  },
  plugins: [],
}
