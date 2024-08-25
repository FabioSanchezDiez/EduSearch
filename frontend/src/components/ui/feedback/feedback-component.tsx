import { fetchFeedbackByProgram } from "@/lib/data";
import { Feedback } from "@/types/definitions";
import FeedbackCard from "./feedback-card";

export default async function FeedbackComponent({ id }: { id: string }) {
  const feedback: Feedback[] = await fetchFeedbackByProgram(id);
  return (
    <section className="flex flex-col gap-2">
      {feedback.length >= 1 ? (
        feedback.map((feedback: Feedback) => (
          <FeedbackCard
            key={feedback.id}
            id={feedback.id}
            feedback={feedback.feedback}
            rating={feedback.rating}
          ></FeedbackCard>
        ))
      ) : (
        <p>Este programa todavía no tiene ninguna opinión.</p>
      )}
    </section>
  );
}
