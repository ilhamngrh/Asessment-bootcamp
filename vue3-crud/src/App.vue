<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container">
        <router-link :to="{ name: 'home' }" class="navbar-brand">HOME</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link :to="{ name: 'mahasiswa.index' }" class="nav-link active" aria-current="page">MAHASISWA</router-link
              >
            </li>

            <li class="nav-item">
              <router-link :to="{ name: 'dosen.index' }" class="nav-link active" aria-current="page">DOSEN</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'matakuliah.index' }" class="nav-link active" aria-current="page">MATAKULIAH</router-link
              >
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'prodi.index' }" class="nav-link active" aria-current="page">PRODI</router-link
              >
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0" role="search">
            <a
              href="https://santrikoding.com"
              target="_blank"
              class="btn btn-success"
              >xxxxxx.COM</a
            >
          </ul>
        </div>
      </div>
    </nav>

    <!--- render router view -->
    <router-view></router-view>

  </div>
</template>