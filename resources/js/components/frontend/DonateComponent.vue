<template>
    <div>
        <b-card-group deck>
        <b-card
            border-variant="primary"
            header="Fill Donation Information"
            header-text-variant="black"
        >
            <b-card-body>
                <NameInputComponent/>
            </b-card-body>
        </b-card>
        </b-card-group>
    </div>
</template>

<script>
    import NameInputComponent from './input/NameInputComponent';

    export default {
        components:{
            NameInputComponent
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
