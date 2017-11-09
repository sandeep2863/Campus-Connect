<template>
    <div>
        <hr>
        <p class="text-center" v-for="like in post.likes">
            <img :src="like.user.avatar" alt="" width="40px" height="40px" class="avatar-like">
        </p>
        <hr>
        <button class="btn btn-xs btn-default">
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
            Like
        </button>
        <button class="btn btn-xs btn-default">
            <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
            Dislike
        </button>

    </div>
</template>

<script>
    export default {
        mounted() {

        },
        props: ['id'],
        computed: {
            post() {
                return this.$store.state.posts.find((post) => {
                    return post.id === this.id
                })
            }
        }
    }
</script>

    <style>
.avatar-like {
    border-radius: 50%;
}
</style>