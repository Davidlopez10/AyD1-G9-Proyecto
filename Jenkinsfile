pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
        sh 'cd AyD1-G9-Proyecto/pensum-toolbox'
        sh 'composer install'
	      sh './vendor/bin/codecept run' 
        sh 'cd ../..'
      }
    }
  }
}
