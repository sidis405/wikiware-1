<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">VueJS Component</div>

                    <div class="card-body">
                        <h1>Hit {{ counter }} times</h1>

                        <button class="btn btn-primary" @click="increment">+</button>
                        <button class="btn btn-danger" @click="decrement">-</button>

                        <div class="alert alert-danger" v-if="warning">
                            Non posso andare sotto 0!
                        </div>
                    </div>

                    <div class="card-body">
                        <input class="form-control" v-model:value="message"></input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                counter: 0,
                message: "This is a property of data"
            }
        },

        computed: {
            warning(){
                return this.counter < 1
            }
        },

        methods: {
            increment(){
                this.counter++

                this.message = this.message + '+'
            },

            decrement(){
                if(this.counter > 0){
                    this.counter--
                }
            }

        }
    }
</script>
