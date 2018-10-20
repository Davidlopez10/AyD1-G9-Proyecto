pipeline {
  agent any
  stages {
    stage('Build') {
      steps { 
	      sh 'pensum-toolbox/vendor/bin/codecept run' 
      }
    }
  }
}
