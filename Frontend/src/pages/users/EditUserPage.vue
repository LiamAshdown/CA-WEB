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
                  :value="user.firstName"
                  @input="updateField"
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
                  :value="user.lastName"
                  @input="updateField"
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
                  :value="user.email"
                  @input="updateField"
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
                    :value="user.role"
                    @input="updateField"
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
                    :value="user.password"
                    @input="updateField"
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
import { mapGetters } from 'vuex'

export default {
  name: 'EditUserPage',

  data () {
    return {
      id: this.$route.params.id,
      title: '...',
      errors: false,
      loading: false,
      initializing: true,
      options: [
        { value: 'company_admin', text: 'Company Admin' },
        { value: 'company_sub_admin', text: 'Company Sub Admin' },
        { value: 'company_user', text: 'Company User' }
      ]
    }
  },
  computed: {
    ...mapGetters({
      user: 'users/user'
    })
  },
  methods: {
    async loadUser () {
      await this.$store.dispatch('users/show', {
        id: this.id
      })

      this.title = `Editing ${this.user.firstName + ' ' + this.user.lastName}`

      this.initializing = false
    },
    updateField (value, field) {
      this.$store.dispatch('users/set', {
        [field]: value
      })
    },
    async onSubmit () {
      this.loading = true

      try {
        await this.$store.dispatch('users/update')
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
