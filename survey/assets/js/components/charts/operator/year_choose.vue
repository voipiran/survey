<template>
    <div>
        نمودار فعالیت سال :
        <select name="year"  v-model="selected" @change="change()" style="border-radius: 5px ; padding-left: 5px ; padding-right: 5px" >
            <option  v-for="year in years" :key="year" >{{ year }}</option>
        </select>
    </div>
</template>

<script>
    import Axios from 'axios'

    export default {
        props : [ 'years' ] ,
        name: "year_choose",
        data(){
            return {
                selected : ''
            }
        },
        methods : {
            change(){
                this.$store.commit('change_year' , this.selected );
            }
        },
        created(){
            Axios.get('functions.php?f=get_this_year')
                .then(response => {
                    this.selected = response.data;
                })
                .catch(error => {
                    console.log(error.data);
                })
        }
    }
</script>

<style scoped>

</style>