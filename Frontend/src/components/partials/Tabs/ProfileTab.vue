<template>
  <b-row>
    <b-col xl="6" lg="12">
      <base-card :loading="initializing">
        <b-form @submit.prevent="onSubmit">
          <base-form-group
            id="email"
            label="Email Address"
            placeholder="example@example.com"
            type="email"
            :optional="false"
            autocomplete="email"
            v-model="profile.email"
            :validation="errors"
          ></base-form-group>
          <b-form-row fluid>
            <b-col lg="6">
              <base-form-group
                id="first-name"
                label="First Name"
                placeholder="First Name"
                type="text"
                :optional="false"
                autocomplete="given-name"
                v-model="profile.firstName"
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
                v-model="profile.lastName"
                :validation="errors"
              ></base-form-group>
            </b-col>
          </b-form-row>
          <base-form-group
            id="password"
            label="Password"
            placeholder="Password"
            type="password"
            autocomplete="new-password"
            v-model="profile.password"
            :validation="errors"
            description="Setting the password is optional :)"
          ></base-form-group>
          <base-button :loading="loading">Update</base-button>
        </b-form>
      </base-card>
    </b-col>
  </b-row>
</template>

<script>
export default {
  name: 'CompanyTab',
  data () {
    return {
      loading: false,
      initializing: true,
      errors: [],
      profile: {
        firstName: '',
        lastName: '',
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async loadProfile () {
      this.profile = await this.$store.dispatch('getProfile')
      this.initializing = false
    },
    async onSubmit () {
      this.loading = true

      try {
        await this.$store.dispatch('updateProfile', this.profile)
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  },
  created () {
    this.loadProfile()
  }
}
</script>
