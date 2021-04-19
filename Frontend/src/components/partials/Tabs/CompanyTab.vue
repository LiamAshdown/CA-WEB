<template>
  <b-row>
    <b-col xl="6" lg="12" class="mb-4">
      <base-card :loading="initializing">
        <b-form @submit.prevent="onSubmit">
          <b-form-row fluid>
            <b-col lg="6">
              <base-form-group
                id="name"
                label="Name"
                placeholder="Name"
                type="text"
                :optional="false"
                autocomplete="organization"
                v-model="company.name"
                :validation="errors"
              ></base-form-group>
            </b-col>
            <b-col lg="6">
              <base-form-group
                id="telephone-number"
                label="Telephone Number"
                placeholder="Telephone Number"
                type="tel"
                :optional="false"
                autocomplete="tel"
                v-model="company.telephoneNumber"
                :validation="errors"
              ></base-form-group>
            </b-col>
          </b-form-row>
          <b-form-row fluid>
            <b-col lg="12">
              <base-form-group
                id="postal-code"
                label="Postal Code"
                placeholder="Postal Code"
                type="text"
                :optional="false"
                autocomplete="postal-code"
                v-model="company.postalCode"
                :validation="errors"
              ></base-form-group>
            </b-col>
            <b-col lg="6">
              <base-form-group
                id="address"
                label="Address"
                placeholder="Address"
                type="text"
                :optional="false"
                v-model="company.address"
                autocomplete="address"
                :textArea="true"
                :validation="errors"
              ></base-form-group>
            </b-col>
          </b-form-row>
          <base-button :loading="loading">Update</base-button>
        </b-form>
      </base-card>
    </b-col>
    <b-col xl="3" lg="12">
      <base-card :loading="initializing">
        <div class="company mb-3">
          <div id="company-logo" class="company__upload">
            <div v-if="!company.logoPath" class="company__upload_info mt-3 text-center">
              <font-awesome-icon icon="cloud-upload-alt" class="text-muted"/>
              <p class="text-muted">Drag a file here or <span class="text-primary">browse</span> to choose a file</p>
            </div>
            <img
              v-else
              :src="company.logoPath"
              class="company__preview"
            />
          </div>
        </div>
        <avatar-cropper
          trigger="company-logo"
          @changed="onChange"
          @uploadHandler="onUploadHandler"
        />
        <small class="text-muted"><font-awesome-icon icon="info-circle" class="text-primary"/> Information about your company that will be displayed on invoices, estimates and other documents created by Contractor Apps.</small>
      </base-card>
    </b-col>
  </b-row>
</template>

<script>
import AvatarCropper from '@/components/AvatarCropper'
import api from '@/api/index.js'

export default {
  name: 'CompanyTab',
  components: {
    AvatarCropper
  },
  data () {
    return {
      loading: false,
      initializing: true,
      cropperOutputMime: '',
      errors: [],
      company: {
        name: '',
        telephoneNumber: '',
        postalCode: '',
        address: '',
        logo: null,
        logoPath: ''
      }
    }
  },
  methods: {
    onUploadHandler (cropper) {
      const logoURL = cropper
        .getCroppedCanvas()
        .toDataURL(this.cropperOutputMime)

      cropper.getCroppedCanvas().toBlob((blob) => {
        this.form.logo = blob
        this.form.logoPath = logoURL
      })
    },
    onChange (file) {
      this.cropperOutputMime = file.type
    },
    async loadCompany () {
      this.company = await api.company.show()
      this.initializing = false
    },
    async onSubmit () {
      this.loading = true

      try {
        await api.company.update(this.company)
      } catch (err) {
        this.errors = err.response.data.errors
      }

      this.loading = false
    }
  },
  created () {
    this.loadCompany()
  }
}
</script>

<style lang="scss">
.company {
  height: 150px;
  border-width: 2px;
  border-style: dashed;
  border-radius: .375rem;
  border-color: #e2e2e2;

  &__upload {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    width: 100%;
    height: 100%;

    p {
      font-size: 0.75rem;
    }
  }

  &__preview {
    position: absolute;
    height: 100%;
  }
}
</style>
