<template>
    <div class="main-content py-5">
        <div class="container">
            <h1 class="text-uppercase mb-5">Blog class #45</h1>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'App',
    components: {

    },
    data() {
        return {
            post: null,
            pagination: null,
        }
    },
    created() {
        axios.get('http://127.0.0.1:8000/api/posts')
            .then(response => {
                this.post = response.data.data;
                console.log(this.post);

                this.pagination = {
                    current: response.data.current_page,
                    last: response.data.last_page,
                };
                console.log(this.pagination);
            })
    }
}
</script>

<style language="scss">

</style>