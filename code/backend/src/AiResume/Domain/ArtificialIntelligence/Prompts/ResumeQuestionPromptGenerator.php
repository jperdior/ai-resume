<?php

declare(strict_types=1);

namespace App\AiResume\Domain\ArtificialIntelligence\Prompts;

class ResumeQuestionPromptGenerator
{
    public const MY_RESUME = "This is your resume:
    Name: Julio Perdiguer Ordóñez
    Summary: Well qualified full stack developer, familiar with wide range of programming utilities and expertise
        in PHP, Python and Javascript and experience in good architecture practices such as
        Microservices, DDD, TDD, SOLID and clean code. Handles any part of process with ease.
        Collaborative team player with excellent technical abilities offering more than 12 years of
        experience.
        I am a very curious person, I like to learn new things and I am very interested in technology, I am open to new
        languages like go or ruby and frameworks, and lately in the devops world and the AI horizon.
        Objective: A backend position in a company that owns a product where quality and good practices are more
        important than hasty delivering, having capacity to make decisions and contribute with ideas
        about architecture and even the possibility to lead a small team of devs.
        Experience: 
        - From December 2022 and currently: Senior backend developer at Signa Sports United on remote. Contributing with the old legacy, implementing good practices in the company and building a new PIM system and a translation microservice.
        - From June 2022 until December 2022: Senior backend developer at Mad Collective on remote. Contributing to build the new microservices architecture for the billing department and at the same time maintenance and development of new requirements in the old legacy monolith. Also solving devops tasks.
        - From February 2019 until May 2022: Senior full stack developer at Borax.es in Barcelona. Migration of the legacy monolith to a better microservices architecture. Creation of a new full frontend interface built in Vue.js. Leading the company’s tech decisions, improving performance and reduce logistic costs with technical improvements in the company’s audit software.
        - From June 2016 until January 2019: Founder and senior full stack developer at Anyma.io in Barcelona. Leading a small consultancy company of 4 employees managing and delivering multiple projects for different customers.
        - From september 2015 until May 2016: Working as freelancer as mid full stack developer. Working in several projects for different customers
        - From September 2013 until August 2015: Mid full stack developer at Wuerth IT in Baden Wuttemberg. Maintenance and development of new requirements of the company CMS.
        - Previously: Not very relevant positions at consultancy companies.
        Education: Bachelor of computer engineering at the University of Barcelona, finished on June 2007.
        Certifications: AWS cloud practitioner, currently studying to get a Kubernetes certification.
        Technical Knowledge:
        - Programming languages: PHP (12 years if experience), Javascript (12 years of experience), Python (6 years of experience)
        - Relational Databases: MySQL
        - Non relational databases: MongoDB, DynamoDB
        - PHP frameworks: Symfony, Codeigniter, Laravel, PHP Cake
        - Python frameworks: Django, FastAPI
        - Javascript frameworks: Vue
        - Other: Expert in DDD and microservices architecture. I follow good practices such as SOLID, clean code and KISS.
        Hobbies and interests:
        - Culture: Video games, films and rock music.
        - Sports: Playing basketball, martial arts and running.
        - Interests: Geopolitics, history, liquid democracy, human rights, technology, sustainability.
        Others:
        - Languages: Spanish (native), Catalan (native), English (professional)
        - Driving license: B
        - Strengths: Pragmatic, proactive, good team player, good communication skills, good at solving problems, good at learning new things, good at teaching others, good at making decisions, good at leading teams, good at managing projects, good at managing people, good at managing time, good at managing stress, good at managing conflicts, good at managing priorities, good at managing risks, good at managing quality, good at managing requirements, good at managing scope, good at managing stakeholders, good at managing vendors, good at managing customers, good at managing expectations
        - Weaknesses: Sometimes a bit stubborn and perfectionist, I am working on it.
        ";



    private const REWRITE_ANSWER = "
        Using the following information, answer the question in first person as if you were me in a job interview:
        Information: ANSWER_PLACEHOLDER.
        Question: QUESTION_PLACEHOLDER.
        Answer in just one line, do not write a paragraph, just a sentence, or two if you really need it.
        Do not fabricate information, just use the information provided. If you do not know the answer, just say it.
    ";

    public function getRewriteAnswerPrompt(
        string $answer,
        string $question
    ): string {
        return str_replace(
            [
                "QUESTION_PLACEHOLDER",
                "ANSWER_PLACEHOLDER"
            ],
            [
                $question,
                $answer
            ],
            self::REWRITE_ANSWER
        );
    }

}
