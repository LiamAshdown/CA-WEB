<template>
  <b-container fluid>
    <h1 class="page-title">Profile</h1>
    <base-tabs>
      <base-tab title="Profile"><profile-tab></profile-tab></base-tab>
      <base-tab title="Company" permission="view company"><company-tab></company-tab></base-tab>
      <base-tab title="Customization" permission="view customization"><customization-tab></customization-tab></base-tab>
    </base-tabs>
  </b-container>
</template>

<script>
import ProfileTab from '@/components/partials/Tabs/ProfileTab.vue'
import CompanyTab from '@/components/partials/Tabs/CompanyTab.vue'
import CustomizationTab from '@/components/partials/Tabs/CustomizationTab.vue'

export default {
  components: {
    ProfileTab,
    CompanyTab,
    CustomizationTab
  },
  name: 'ProfilePage'
}
</script>
