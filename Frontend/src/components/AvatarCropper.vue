<template>
  <div class="avatar-cropper">
    <div
      class="avatar-cropper__overlay"
      v-if="dataUrl"
    >
      <div class="avatar-cropper__container">
        <div class="avatar-cropper__container__image">
          <img
            :src="dataUrl"
            @load.stop="createCropper"
            alt
            ref="img"
          >
        </div>
        <div class="avatar-cropper__footer">
          <button
            @click.stop.prevent="cancel"
            class="avatar-cropper__btn"
          >Cancel</button>
          <button
            @click.stop.prevent="submit"
            class="avatar-cropper__btn"
          >Submit</button>
        </div>
      </div>
    </div>
    <input
      :accept="mimes"
      class="avatar-cropper__img_input"
      ref="input"
      type="file"
    >
  </div>
</template>

<script>
import 'cropperjs/dist/cropper.css'
import Cropper from 'cropperjs'

export default {
  props: {
    trigger: {
      type: [String, Element],
      required: true
    },
    cropperOptions: {
      type: Object,
      required: false,
      default () {
        return {
          aspectRatio: 1,
          autoCropArea: 1,
          viewMode: 1,
          movable: false,
          zoomable: false
        }
      }
    },
    mimes: {
      type: String,
      required: false,
      default: 'image/png, image/jpeg, image/bmp, image/x-icon'
    },
    inline: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data () {
    return {
      cropper: undefined,
      dataUrl: undefined,
      filename: undefined
    }
  },
  methods: {
    destroy () {
      if (this.cropper) {
        this.cropper.destroy()
      }

      this.$refs.input.value = ''
      this.dataUrl = undefined
    },
    submit () {
      this.$emit('uploadHandler', this.cropper)
      this.destroy()
    },
    cancel () {
      this.destroy()
    },
    pickImage () {
      this.$refs.input.click()
    },
    createCropper () {
      this.cropper = new Cropper(this.$refs.img, this.cropperOptions)
    }
  },
  mounted () {
    const trigger = document.getElementById(this.trigger)
    if (!trigger) {
      console.error('Cropper: Cannot find trigger: ' + this.trigger)
      return
    }

    trigger.addEventListener('click', this.pickImage)

    // listen for input file changes
    const fileInput = this.$refs.input

    fileInput.addEventListener('change', () => {
      if (fileInput.files != null && fileInput.files[0] != null) {
        const correctType = this.mimes.split(', ').find(m => m === fileInput.files[0].type)

        if (!correctType) {
          console.error('Cropper: Incorrect type')
          return
        }

        const reader = new FileReader()
        reader.onload = e => {
          this.dataUrl = e.target.result
        }
        reader.readAsDataURL(fileInput.files[0])

        this.filename = fileInput.files[0].name || 'unknown'
        this.mimeType = this.mimeType || fileInput.files[0].type

        this.$emit('changed', fileInput.files[0], reader)
      }
    })
  }
}
</script>

<style lang="scss">
.avatar-cropper {
  &__overlay {
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99999;
  }

  &__img_input {
    display: none;
  }

  &__container {
    background: #fff;
    z-index: 999;
    box-shadow: 1px 1px 5px rgba(100, 100, 100, 0.14);
    &__image {
      position: relative;
      max-width: 400px;
      height: 300px;
    }
    img {
      max-width: 100%;
      height: 100%;
    }
  }

  &__footer {
    display: flex;
    align-items: stretch;
    align-content: stretch;
    justify-content: space-between;
  }

  &__btn {
    width: 50%;
    padding: 15px 0;
    cursor: pointer;
    border: none;
    background: transparent;
    outline: none;

    &:hover {
      background-color: $primary;
      color: #fff;
    }
  }
}
</style>
