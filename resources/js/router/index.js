import Donate from '../views/frontend/Donate.vue'
import About from '../views/About.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'frontend-home',
            components: {
                Content: Donate
            },
        },
        {
            path: '/about',
            name: 'frontend-about',
            navbar: 'frontend',
            components:{
                Content: About,
            } 
        }
    ]
}