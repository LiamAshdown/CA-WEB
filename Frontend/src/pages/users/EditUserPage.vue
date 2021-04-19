<template>
  <b-container fluid>
    <h1 class="page-title">{{ title }}</h1>
    <b-row>
      <b-col cols="12" lg="6">
        <base-card :loading="initializing">
          <b-form @submit.prevent="onSubmit">
            <b-form-row fluid>
              <b-col lg="6">
                <base-form-group
                  id="first-name"
                  label="First Name"
                  placeholder="First Name"
                  type="text"
                  :optional="false"
                  autocomplete="given-name"
                  v-model="user.firstName"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              <b-col lg="6">
                <base-form-group
                  id="last-name"
                  label="Last Name"
                  placeholder="Last Name"
                  type="text"
                  :optional="false"
                  autocomplete="family-name"
                  v-model="user.lastName"
                  :validation="errors"
                ></base-form-group>
              </b-col>
            </b-form-row>
            <b-form-row fluid>
              <b-col lg="12">
                <base-form-group
                  id="email"
                  label="Email"
                  placeholder="example@example.com"
                  type="email"
                  :optional="false"
                  autocomplete="email"
                  v-model="user.email"
                  :validation="errors"
                ></base-form-group>
              </b-col>
              </b-form-row>
              <b-form-row>
                <b-col lg="12">
                  <base-form-group
                    id="role"
                    label="Role"
                    placeholder="Choose Role"
                    :select="true"
                    :optional="false"
                    v-model="user.role"
                    :options="options"
                    :validation="errors"
                  ></base-form-group>
                </b-col>
              </b-form-row>
              <b-form-row>
                <b-col lg="6">
                  <base-form-group
                    id="password"
                    label="Password"
                    placeholder="Password"
                    type="password"
                    :optional="false"
                    autocomplete="new-password"
                    v-model="user.password"
                    :validation="errors"
                  ></base-form-group>
                </b-col>
              </b-form-row>
              <base-button :loading="loading">Update</base-button>
          </b-form>
        </base-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import api from '@/api/index.js'
import { snakeCase } from '@/helpers/utils'

export default {
  name: 'EditUserPage',

  data () {
    return {
      title: '...',
      errors: false,
      loading: false,
      initializing: true,
      user: {
        id: null,
        firstName: '',
        lastName: '',
        email: '',
        role: '',
        password: ''
      },
      options: [
        { value: 'company_admin', text: 'Company Admin' },
        { value: 'company_sub_admin', text: 'Company Sub Admin' },
        { value: 'company_user', text: 'Company User' }
      ]
    }
  },
  methods: {
    async loadUser () {
      this.user = await api.users.show(this.$route.params.id)

      this.user.role = snakeCase(this.user.role)
      this.title = `Editing ${this.user.firstName + ' ' + this.user.lastName}`

      this.initializing = false
    },
    async onSubmit () {
      this.loading = true

      try {
        const response = await api.users.update(this.user)

        this.$store.dispatch('toast', {
          message: response.message
        })

        this.$router.push({ name: 'Users' })
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  },
  created () {
    this.loadUser()
  }
}
</script>
