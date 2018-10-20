pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
        sh 'pensum-toolbox/vendor/bin/codecept bootstrap'
	      sh 'pensum-toolbox/vendor/bin/codecept run' 
      }
    }
  }
}
