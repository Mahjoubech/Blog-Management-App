tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#22BAA0',
                secondary: '#34425A',
                neutral: '#B0B0B0',
            }
        }
    }
}

module.exports = {
    content: ["./src/**/*.{php,js}"],
    theme: {
        extend: {},
    },
    plugins: [],
}