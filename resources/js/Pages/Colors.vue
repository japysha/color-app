<script>
import {Form} from "@/clasess/Form";

export default {
    name: "Colors",

    data() {
        return {
            form: new Form({
                name: '',
                hex_code: ''
            }),
            colorList: this.colors,
        }
    },

    methods: {
        onSubmit() {
            // show some loader
            this.form.post('/api/colors')
                .then(response => {
                    this.colorList.push(response);
                    // hide loader
                })
                .catch(error => {
                    // hide loader
                });
        },

        change() {
            this.form.color = 'Changed value'
        },

        removeColor(index, colorName) {
            // show loader
            axios.delete('/api/colors', {
                data: {
                    name: colorName
                }
            })
            .then(response => {
                this.colorList.splice(index, 1);
                // hide loader
            })
            .catch(error => {
                // hide loader
                this.errors = error.response.data.errors;
            });
        }
    },

    mounted() {
        axios.get('/api/colors')
            .then(response => {
                this.colorList = response.data;
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            });
    }
}
</script>

<template>
    <div class="mt-2" >
        <h1 class="xl:font-bold block bg-gray-300 text-black px-3 py-2 cursor-pointer text-white bg-gray-600"
            >Colors<span class="float-right"></span></h1>
        <div class="mt-1 mb-5">
            <ul>
                <li v-for="(color, index) in colorList" class="relative px-3 py-2 bg-gray-100 my-1 hover:bg-blue-200">
                    <div class="flex-column">
                        <div style="display: inline-block; width: 20px; height: 20px; margin-right: 15px;"
                             :style="{'background-color': color.hex_code}"></div>
                        <span v-text="color.name"></span>
                    </div>

                    <div class="absolute right-1 top-0.5 cursor-pointer" @click="removeColor(index, color.name)">remove</div>
                </li>
            </ul>

            <form @submit.prevent="onSubmit" class="mt-1 flex-column w-1/3 m-auto"
                  @keydown="form.errors.clear($event.target.name)">

                <h3 class="font-bold mt-3">Add color</h3>
                <div class="flex-column mt-3 grid grid-cols-6 gap-4">
                    <div class="col-start-1 col-end-2">
                        <label for="name" class="col-start-1 col-end-2">name:</label>
                    </div>
                    <div class="ml-3 flex flex-col items-left col-start-2 col-end-7">
                        <input type="text" id="name" name="name" v-model="form.name" class="w-full rounded border-gray-400 px-2 py-1">
                    </div>
                    <span class="help text-red-700 col-start-1 col-end-7" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
                </div>
                <div class="flex-column mt-3 grid grid-cols-6 gap-4">
                    <div class="col-start-1 col-end-2">
                        <label for="hex_code" class="col-start-1 col-end-2">hex_code:</label>
                    </div>
                    <div class="ml-3 flex flex-col items-left col-start-2 col-end-7">
                        <input type="text" id="hex_code" name="hex_code" v-model="form.hex_code" class="w-full rounded border-gray-400 px-2 py-1">
                    </div>
                    <span class="help text-red-700 col-start-1 col-end-7" v-if="form.errors.has('hex_code')" v-text="form.errors.get('hex_code')"></span>
                </div>
                <button
                    :disabled="form.errors.any()"
                    class="mt-4 p-2 rounded-sm bg-blue-900 hover:bg-red-700 w-full text-center text-sm font-medium text-white transition duration-150 ease-in-out"
                >Confirm</button>
            </form>
        </div>
    </div>
</template>
