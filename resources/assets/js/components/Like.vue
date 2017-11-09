<template>
    <div>
        <hr>
        <p class="text-center" v-for="like in post.likes">
            <img :src="like.user.avatar" alt="" width="40px" height="40px" class="avatar-like">
        </p>
        <hr>
        <button class="btn btn-xs btn-default" v-if="!auth_user_likes_post">
            Like
        </button>
        <button class="btn btn-xs btn-default" v-else>
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
            likes() {
                var likers = []
                this.post.likes.forEach((like) => {
                    likers.push(like.user.id)
                })
                return likers
            },
            auth_user_likes_post() {
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                )

                if (check_index == -1)
                    return false
                else
                    return true
            },
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