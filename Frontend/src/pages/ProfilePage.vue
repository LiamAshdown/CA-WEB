<template>
  <b-container fluid>
    <h1 class="page-title">Profile</h1>
    <base-tabs>
      <base-tab title="Profile"><profile-tab></profile-tab></base-tab>
      <base-tab title="Company"><company-tab></company-tab></base-tab>
    </base-tabs>
  </b-container>
</template>

<script>
import ProfileTab from '../components/partials/Tabs/ProfileTab.vue'
import CompanyTab from '../components/partials/Tabs/CompanyTab.vue'

export default {
  components: {
    ProfileTab,
    CompanyTab
  },
  name: 'ProfilePage'
}
</script>
