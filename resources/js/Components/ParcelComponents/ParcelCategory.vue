<template>
    <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
        <div class="bg-white shadow sm:rounded-sm overflow-hidden rounded">
            <header class="text-white bg-red-600 py-2 px-4 flex">
                <h3 class="text-lg sm:text-xl inline font-black flex-1">
                    Add/Remove Parcel Category
                </h3>
            </header>

            <div class="card bg-white shadow-md rounded">
                <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" name="form_category" @submit.prevent="saveCategory">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                            Save Category *
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category" type="text" placeholder="Enter Category" v-model="category" required>
                    </div>
                    <div>
                        <button type="submit" class="col-span-2 mx-1 rounded-md border border-transparent px-2 py-1 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-black focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            <font-awesome-icon :icon="['far', 'save']" />  Save
                        </button>
                    </div>
                </form>
                
                <div class="mt-3 px-4 pb-2" v-if="categories.length > 0">
                    <span v-for="category in categories" :key="category.id" class="rounded-full px-1 mb-4 inline-block">
                        <font-awesome-icon @click="deleteCategory(category.id)" icon="times-circle" class="text-red-500 cursor-pointer mr-1 float-right" />
                        <span class="px-3 py-1 bg-green-300 rounded-full">
                            <strong>{{ category.category }}</strong>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HttpClient from "../../Mixins/HttpClient";
export default {

    data(){
        return {
            category:'',
            categories:[]
        }
    },
    beforeMount(){
        this.loadCategory();
    },
    methods:{
        saveCategory(){
            let data = new FormData();

            data.append('category', this.category);

            HttpClient.client
            .post("/parcel/category/store", data)
            .then((response) => {
                this.handleSave(response.data);
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });
        },
        handleSave(data){
            if(data.status == 'success'){
                this.loadCategory();
                this.category = '';
                document.forms['form_category'].reset();
            }else{
                console.log(data.message);
            }
        },
        loadCategory(){
            HttpClient.client
            .post("/parcel/category/fetch")
            .then((response) => {
                this.categories = response.data;
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });
        },
        deleteCategory(id){
            {HttpClient.client
            .delete(`/parcel/category/delete?id=${id}`)
            .then((response) => {
                this.loadCategory();
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });}
        }
    }
}
</script>
