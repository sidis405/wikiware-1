<template>
    <div class="card">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <ul>
                <li v-for="category in categories">
                    <a href="#" >{{ category.name }} ({{ category.posts_count }})</a>
                </li>
            </ul>

            <hr>
            <input type="text" class="form-control" v-model:value="adding" @keyup.enter="addCategory">
        </div>
    </div>
</template>
<script>
    export default {

        data(){
            return {
                categories: [],
                adding: null
            }
        },

        mounted(){
            this.getCategories()
        },

        methods: {

            addCategory(){

                this.categories.push({
                    'name': this.adding
                })

                this.adding = null

            },

            getCategories(){
                axios.get('/categories').then((response) => {
                    this.categories = response.data
                })
            }
        }

    }
</script>
