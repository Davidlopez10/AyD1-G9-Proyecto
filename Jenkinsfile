pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
        sh 'bootstrap'
	      sh 'pensum-toolbox/vendor/bin/codecept run' 
      }
    }
  }
}
