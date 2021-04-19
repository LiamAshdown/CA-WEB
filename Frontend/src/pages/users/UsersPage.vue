<template>
  <b-container fluid>
    <h1 class="page-title">User Management</h1>
  <div class="d-flex justify-content-end">
    <base-button class="mb-3" :to="{ name: 'AddUser' }">Add User</base-button>
  </div>
  <base-card>
    <h4>Filter</h4>
      <b-form class="mb-5">
        <b-form-input
          v-model="filter"
          placeholder="Search"
        ></b-form-input>
      </b-form>
      <b-table
        striped
        hover
        stacked="sm"
        :per-page="perPage"
        :current-page="currentPage"
        :filter="filter"
        :busy="loading"
        :fields="fields"
        :items="users"
      >
        <template #table-busy>
          <div class="text-center text-primary my-2">
            <b-spinner class="align-middle"></b-spinner>
            <strong> Loading...</strong>
          </div>
        </template>

        <template #cell(action)="data">
          <b-dropdown split variant="primary" :split-to="{ name: 'EditUser', params: { id: data.item.id } }" text="Edit" class="m-2">
            <b-dropdown-item href="#" disabled>Remove (TODO)</b-dropdown-item>
          </b-dropdown>
        </template>
      </b-table>
      <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
    ></b-pagination>
    </base-card>
  </b-container>
</template>

<script>
import api from '@/api/index.js'

export default {
  name: 'UsersPage',

  data () {
    return {
      perPage: 5,
      currentPage: 1,
      loading: true,
      filter: '',
      selected: null,
      users: [],
      options: [
        { value: null, text: 'Choose Role' },
        { value: 'company_admin', text: 'Company Admin' },
        { value: 'company_sub_admin', text: 'Company Sub Admin' },
        { value: 'company_user', text: 'Company User' }
      ],
      fields: [
        'firstName',
        'lastName',
        'role',
        'action'
      ]
    }
  },
  computed: {
    rows () {
      return this.users.length
    }
  },
  methods: {
    async loadUsers () {
      this.users = await api.users.index()
      this.loading = false
    }
  },
  mounted () {
    this.loadUsers()
  }
}
</script>
