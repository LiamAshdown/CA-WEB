<template>
  <b-container fluid>
    <h1 class="page-title">User Management</h1>
  <div class="d-flex justify-content-end">
    <base-button class="mb-3" :to="{ name: 'AddUser' }">Add User</base-button>
  </div>
  <base-card>
    <h4>Filter</h4>
      <b-form class="mb-5">
        <b-form-row>
          <b-col cols="12" lg="6" class="mb-3">
            <b-form-input
              id="inline-form-input-name"
              placeholder="Search"
            ></b-form-input>
          </b-col>
          <b-col cols="12" lg="6">
            <b-form-select v-model="selected" :fields="fields" :options="options"></b-form-select>
          </b-col>
        </b-form-row>
      </b-form>
      <b-table striped hover stacked="sm" :fields="fields" :items="items">
        <template #cell(action)>
          <base-button>Edit</base-button>
        </template>
      </b-table>
    </base-card>
  </b-container>
</template>

<script>
export default {
  name: 'UsersPage',

  data () {
    return {
      selected: null,
      options: [
        { value: null, text: 'Choose Role' },
        { value: 'company_admin', text: 'Company Admin' },
        { value: 'company_sub_admin', text: 'Company Sub Admin' },
        { value: 'company_user', text: 'Company User' }
      ],
      fields: [
        'first_name',
        'last_name',
        'role',
        'action'
      ],
      items: [
        { first_name: 'Dickerson', last_name: 'Macdonald', role: 'Company Admin' }
      ]
    }
  }
}
</script>
