<template>
  <v-data-table
    dense
    :headers="headers"
    :items="employees"
    :items-per-page="5"
    class="elevation-4 mt-6"
  ></v-data-table>
</template>

<script>
  export default {
    data () {
      return {
        employees: [],
        headers: [
          {
            text: 'Name',
            align: 'start',
            sortable: false,
            value: 'employee_name',
          },
          { text: 'Gender', value: 'gender' },
          { text: 'Contract Status', value: 'contract_status' },
          { text: 'Company Name', value: 'company_name' },
          { text: 'Department Name', value: 'department_name' },
        ],

      }
    },
    created(){
        this.onload()
    },
    methods:{
            onload() {
            let url = "/api/employee";
            axios.get(url).then((res) => {
        
            console.log(res.data);
            // this.progress = false;
            this.employees = res.data;
    
        });
        },
    }
    
    
  }
</script>