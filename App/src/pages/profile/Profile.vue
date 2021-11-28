<template>
   <div>
      <v-tabs
        background-color="primary"
        centered
        dark
      >
      <v-tabs-slider/>
      <v-tab>Profile</v-tab>
      <v-tab>Company</v-tab>
      <v-tab>Customization</v-tab>

      <v-tab-item>
        <profile-tab></profile-tab>
      </v-tab-item>

      <v-tab-item>
        <company-tab></company-tab>
      </v-tab-item>

      <v-tab-item>
        <profile-tab></profile-tab>
      </v-tab-item>
    </v-tabs>
  </div>
</template>

<script>
import ProfileTab from './tabs/Profile'
import CompanyTab from './tabs/Company'

export default {
  name: 'ProfilePage',
  components: {
    ProfileTab,
    CompanyTab
  },
  data () {
    return {
    }
  }
}
</script>
