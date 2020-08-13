import DonateComponent from '../components/frontend/DonateComponent.vue'
import About from '../views/About.vue'

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'frontend-home',
            components: {
                Content: DonateComponent
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