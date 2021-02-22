<template>
    <div>
        نمودار فعالیت اپراتورها در سال :
        <select name="year"  id="year" v-model="selected" @change="change()" style="border-radius: 5px ; padding-left: 5px ; padding-right: 5px" >
            <option  v-for="year in years" >{{ year }}</option>
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
        beforeCreate(){
            Axios.post('core/dashboard/dashboard_funcs.php?f=get_year')
                .then(response => {
                    this.selected = response.data;
                    document.getElementById('year').value = this.selected;
                    this.$store.state.selected_year = response.data;
                })
                .catch(error => {
                    console.log(error.data);
                })
        }
    }
</script>

<style scoped>

</style>