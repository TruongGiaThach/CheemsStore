        import Vue from 'vue'
        import Vuetify from 'vuetify/lib'
        import '@mdi/font/css/materialdesignicons.css'

        Vue.use(Vuetify)

        const opts = {
                theme: {
                        dark: false,
                }
        }

        export default new Vuetify(opts)