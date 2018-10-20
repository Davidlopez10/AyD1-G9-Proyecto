pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
        sh 'composer install'
	sh './vendor/bin/codecept run' 
      }
    }
  }
}
