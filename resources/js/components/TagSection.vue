<template>
    <div class="card">
        <div class="card-header">Tags</div>
        <div class="card-body">
            <a :href="tag.show_route" v-for="tag in tags" :style="`font-size: ${tag.posts_count * 1.1}px`">{{ tag.name }}&nbsp;</a>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['tags']

    }
</script>
