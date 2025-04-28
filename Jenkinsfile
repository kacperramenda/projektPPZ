pipeline {
    agent any

    environment {
        DOCKER_IMAGE_NAME = 'my-laravel-app'
        DOCKER_CONTAINER_APP = 'laravel-app'
        DOCKER_CONTAINER_DB = 'laravel-db'
        GIT_REPO = 'git@github.com:kacperramenda/projektPPZ.git'
        PROD_BRANCH = 'master'
    }

    stages {
        stage('Checkout') {
            steps {
                withCredentials([sshUserPrivateKey(credentialsId: '2727f907-615e-451a-86c8-9bf91e436837', keyFileVariable: 'PK')]) {
                    checkout([
                        $class: 'GitSCM',
                        branches: [[name: "${PROD_BRANCH}"]],
                        userRemoteConfigs: [[
                            url: "${GIT_REPO}"
                        ]]
                    ])
                }
            }
        }

        stage('Build Docker Image') {
            steps {
                sh "sudo docker build -t ${DOCKER_IMAGE_NAME}:latest ."
            }
        }

        stage('Deploy to Docker Container') {
            steps {
                script {
                    sh '''
                    sudo docker stop ${DOCKER_CONTAINER_APP} || true
                    sudo docker stop ${DOCKER_CONTAINER_DB} || true
                    sudo docker rm ${DOCKER_CONTAINER_APP} || true
                    sudo docker rm ${DOCKER_CONTAINER_DB} || true
                    sudo docker run -d --name ${DOCKER_CONTAINER_DB} -e MYSQL_ROOT_PASSWORD=secret mysql:8.0
                    sudo docker run -d --name ${DOCKER_CONTAINER_APP} -p 80:9000 --link ${DOCKER_CONTAINER_DB}:db ${DOCKER_IMAGE_NAME}:latest
                    '''
                }
            }
        }

        stage('Run Laravel Migrations') {
            steps {
                script {
                    sh "sudo docker exec ${DOCKER_CONTAINER_APP} php artisan migrate --force"
                }
            }
        }
    }

    post {
        always {
            echo 'Pipeline zakończony.'
        }
        success {
            echo 'Pipeline zakończony sukcesem.'
        }
        failure {
            echo 'Pipeline zakończony niepowodzeniem.'
        }
    }
}