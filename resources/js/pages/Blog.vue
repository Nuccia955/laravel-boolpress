<template>
    <div class="main-content py-5">
        <div class="container">
            <h1 class="text-uppercase mb-5">Blog class #45</h1>

            <section class="posts mb-4" v-if="posts">
                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item" v-for="post in posts" :key="`post-${post.id}`">
                        <h3 class="mb-1">{{ post.title }}</h3>
                        <div class="date mb-2">{{ formatDate(post.created_at) }}</div>
                        <p class="mb-3">{{ post.body }}</p>

                        <router-link class="btn btn-orange" :to="{name: 'post-detail', params: post.slug }">Show details</router-link>
                    </li>
                </ul>

                <div class="actions d-flex w-100 justify-content-center">
                    <button class="btn btn-orange mr-3"
                    @click="getPosts(pagination.current - 1)"
                    :disabled="pagination.current === 1"
                    >
                        Prev
                    </button>

                    <button class="btn btn-orange"
                    @click="getPosts(pagination.current + 1)"
                    :disabled="pagination.current === pagination.last"
                    >
                        Next
                    </button>
                </div>
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
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(response => {
                this.posts = response.data.data;
                console.log(this.posts);

                this.pagination = {
                    current: response.data.current_page,
                    last: response.data.last_page,
                };
                console.log(this.pagination);
            })
        },
        formatDate($postDate) {
            const date = new Date($postDate);

            return new Intl.DateTimeFormat('it-IT').format(date);
        }
    }
}
</script>

<style language="scss">

.btn.btn-orange {
    background-color: orange;
}
</style>