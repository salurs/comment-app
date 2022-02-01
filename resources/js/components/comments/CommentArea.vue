<template>
    <div>
        <Comment />
        <Add :parent_id="null" />
    </div>
</template>

<script>
    import Comment from './Comment'
    import Add from './Add'
    export default {
        name: 'comment-area',
       components:{
           Comment,
           Add
       }
    }
</script>
