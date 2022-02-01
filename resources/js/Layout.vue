<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 my-5">
                <CommentArea/>
            </div>
        </div>
    </div>
</template>

<script>
    import CommentArea from "./components/comments/CommentArea";
    export default {
        name: "Layout",
        components:{
            CommentArea
        }
    }
</script>

<style scoped>

</style>
