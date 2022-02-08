<template>
    <div class="main-content py-5">
        <div class="container">
            <h1 class="text-uppercase mb-5">Blog class #45</h1>

            <section class="posts mb-4" v-if="posts">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="post in posts" :key="`post-${post.id}`">
                        <h3 class="mb-2">{{ post.title }}</h3>
                        <p>{{ post.body }}</p>
                    </li>
                </ul>
            </section>

            <div class="loader text-center" v-else>
                <span class="fs-4">Loading posts..</span>
            </div>
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
            posts: null,
            pagination: null,
        }
    },
    created() {
        axios.get('http://127.0.0.1:8000/api/posts')
            .then(response => {
                this.posts = response.data.data;
                console.log(this.posts);

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